<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        if ($request->notification_id) {
            $userUnreadNotification = auth()->user()
                ->unreadNotifications
                ->where('id', $request->notification_id)
                ->first();

            if ($userUnreadNotification) {
                $userUnreadNotification->markAsRead();
            }
        }

        $order = Order::find($id);
        abort_if(!$order, 404);

        if ($order->payment_type_id === 3 && $order->orderOnlinePayment->bank_order_id !== null) {
            $data = [
                'userName' => config('online-payment.userName'),
                'password' => config('online-payment.password'),
                'orderId'  => $order->orderOnlinePayment->bank_order_id
            ];

            $response = Http::withOptions([
                'verify' => false,
            ])->get('https://agn.rysgalbank.tm/epg/rest/getOrderStatusExtended.do', $data);

            if ($response->successful()) {
                if ($response['errorCode']) {
                    $order->errorMessage = $response['errorMessage'];
                    return;
                }

                switch ($response['orderStatus']) {
                    case 0:
                        $orderStatusDescription = 'Order registered, but not paid';
                        break;
                    case 1:
                        $orderStatusDescription = 'Preauthorization amount was put on hold (for a two-phase payment)';
                        break;
                    case 2:
                        $orderStatusDescription = 'Amount was deposited successfully';
                        break;
                    case 3:
                        $orderStatusDescription = 'Authorization has been reversed';
                        break;
                    case 4:
                        $orderStatusDescription = 'Transaction has been refunded';
                        break;
                    case 5:
                        $orderStatusDescription = 'Authorization has been initiated via the issuer???s ACS';
                        break;
                    case 6:
                        $orderStatusDescription = 'Authorization is declined';
                        break;
                }

                $order->orderStatus = $response['orderStatus'];
                $order->orderStatusDescription = $orderStatusDescription;
                $order->actionCode = $response['actionCode'];
                $order->actionCodeDescription = $response['actionCodeDescription'];
            }
        }

        $order->load([
            'orderProducts.product.translation'
        ]);

        return view('admin.orders.products', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OrderProduct $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\OrderProduct $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderProduct $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrderProduct $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //
    }
}
