<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\Admin;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'first_name' => $request->user()->first_name,
            'last_name' => $request->user()->last_name,
            'email' => $request->user()->email,
            'phone' => $request->user()->phone,
            'address' => $request->user()->address,
        ]);

        foreach ($request->products as $product) {
            $productModel = Product::inStock()->with(['translations'])->find($product['id']);
            if (!$productModel) {
                $order->forceDelete();
                return response([
                    'success' => false,
                    'message' => [
                        'tk' => 'Önüm tapylmady',
                        'en' => 'Product not found',
                        'ru' => 'Товар не найден',
                    ]
                ], 404);
            }

            $order->orderProducts()->create([
                'product_id' => $productModel->id,
                'name' => $productModel->translate('ru')->name,
                'price' => $productModel->price,
                'quantity' => $product['quantity'],
            ]);
        }

        return response([
            'success' => true,
            'message' => [
                'tk' => 'Sargyt üstünlikli döredildi',
                'en' => 'Order successfully created',
                'ru' => 'Заказ успешно создан',
            ],
            'order_id' => $order->id,
            'final_price' => $order->total,
            'payment_methods' => PaymentTypeResource::collection(PaymentType::active()->get())
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'order_id' => 'required|exists:orders,id',
            'address' => 'required|string',
            'comment' => 'nullable|string',
            'payment_method' => 'required|exists:payment_types,id',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $order = Order::find($request->order_id);

        if ($order->is_approved) {
            return response([
                'success' => false,
                'message' => [
                    'tk' => 'Sargyt eýýäm tassyklandy',
                    'en' => 'The order has already been approved',
                    'ru' => 'Заказ уже одобрен',
                ],
            ], 400);
        }

        $order->update([
            'address' => $request->address,
            'comment' => $request->comment,
            'payment_type_id' => $request->payment_method,
        ]);

        $admins = Admin::all();
        $admins->each(
            fn ($admin) => $admin->notify(new NewOrder($order))
        );

        if ($request->payment_method == 1 || $request->payment_method == 2) {
            $order->update([
                'is_approved' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'tk' => 'Sargyt üstünlikli tassyklandy',
                    'en' => 'Order has been successfully approved',
                    'ru' => 'Заказ был успешно одобрен',
                ],
            ]);
        } elseif ($request->payment_method == 3) {
            return $this->onlinePayment($request, $order);
        } elseif ($request->payment_method == 4) {
            $order->update([
                'is_approved' => true
            ]);

            return response([
                'success' => true,
                'message' => [
                    'tk' => 'Sargyt üstünlikli tassyklandy',
                    'en' => 'Order has been successfully approved',
                    'ru' => 'Заказ был успешно одобрен',
                ],
                'qr_code' => asset('images/rysgal-pay.png')
            ]);
        } else {
            $order->forceDelete();
            return response([
                'success' => false,
                'message' => [
                    'tk' => 'Nädogry töleg usuly',
                    'en' => 'Wrong payment method',
                    'ru' => 'Неверный способ оплаты',
                ]
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
            return response([
                'success' => false,
                'message' => [
                    'tk' => $response['errorMessage'],
                    'en' => $response['errorMessage'],
                    'ru' => $response['errorMessage'],
                ]
            ], 401);
        } else {
            $order->orderOnlinePayment()->create([
                'bank_order_id' => $response['orderId']
            ]);

            $order->update([
                'is_approved' => true
            ]);

            return response([
                'success' => true,
                'message' => [
                    'tk' => 'Sargyt üstünlikli tassyklandy',
                    'en' => 'Order has been successfully approved',
                    'ru' => 'Заказ был успешно одобрен',
                ],
                'link' => $response['formUrl']
            ]);
        }
    }
}
