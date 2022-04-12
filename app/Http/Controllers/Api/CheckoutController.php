<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailOrderConfirmationJob;
use App\Mail\OrderConfirmation;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:8',
            'address' => 'required|string',
            'comment' => 'nullable|string',
            'payment_type_id' => 'required|exists:payment_types,id',
            'products' => 'required|array',
            'products.*.slug' => 'required|string',
            'products.*.price' => 'required|numeric',
            'products.*.quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $order = Order::create([
            'user_id' => $request->user_id ?? null,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'comment' => $request->comment,
            'payment_type_id' => $request->payment_type_id,
            'is_approved' => true
        ]);

        foreach ($request->products as $product) {
            $productModel = Product::whereTranslation('slug', $product['slug'])->first();
            if (!$productModel) {
                $order->delete();
                return response()->json([
                    'errorMessage' => 'Product not found'
                ], 404);
            }

            $order->orderProducts()->create([
                'product_id' => $productModel->id,
                'name' => $productModel->translate('ru')->name,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);
        }

        // dispatch(new SendMailOrderConfirmationJob($order->email, $order->id));
//        Mail::to($order->email)->send(new OrderConfirmation($order->id));
        $admins = Admin::all();
        $admins->each(
            fn ($admin) => $admin->notify(new NewOrder($order))
        );

        if ($request->payment_type_id == 1 || $request->payment_type_id == 2) {
            return response()->json('Order created successfully.', 201);
        } elseif ($request->payment_type_id == 3) {
            return $this->onlinePayment($request, $order);
        } elseif ($request->payment_type_id == 4) {
            return response()->json([
                'order_id' => $order->id
            ], 201);
        } else {
            $order->delete();
            return response()->json([
                'errorMessage' => 'Wrong data'
            ], 401);
        }
    }

    public function onlinePayment(Request $request, Order $order)
    {
        $data = [
            'userName' => config('online-payment.userName'),
            'password' => config('online-payment.password'),
            'orderNumber' => $order->id,
            'amount' => str_replace([",", "."], "", strval($order->total)),
            'currency' => 934,
            'returnUrl' => config('app.url') . '/payment'
        ];

        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://agn.rysgalbank.tm/epg/rest/register.do', $data);

        if (isset($response['errorCode'])) {
            $order->delete();
            return response([
                'errorMessage' => $response['errorMessage']
            ], 401);
        } else {
            $order->orderOnlinePayment()->create([
                'bank_order_id' => $response['orderId']
            ]);

            return response([
                'payment_url' => $response['formUrl']
            ], 200);
        }
    }
}
