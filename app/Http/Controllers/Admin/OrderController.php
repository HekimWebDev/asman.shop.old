<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()
            ->with([
                'user',
                'paymentType.translation'
            ])
            ->withCount('orderProducts')
            ->get();

        // $orders->each(function ($order) {
        //     if ($order->payment_type_id === 3 && $order->orderOnlinePayment->bank_order_id !== null) {
        //         $data = [
        //             'userName' => config('online-payment.userName'),
        //             'password' => config('online-payment.password'),
        //             'orderId' => $order->orderOnlinePayment->bank_order_id
        //         ];

        //         $response = Http::withOptions([
        //             'verify' => false,
        //         ])->get('https://agn.rysgalbank.tm/epg/rest/getOrderStatusExtended.do', $data);

        //         if ($response->successful()) {
        //             if ($response['errorCode']) {
        //                 $order->errorMessage = $response['errorMessage'];
        //                 return;
        //             }

        //             switch ($response['orderStatus']) {
        //                 case 0:
        //                     $orderStatusDescription = 'Order registered, but not paid';
        //                     break;
        //                 case 1:
        //                     $orderStatusDescription = 'Preauthorization amount was put on hold (for a two-phase payment)';
        //                     break;
        //                 case 2:
        //                     $orderStatusDescription = 'Amount was deposited successfully';
        //                     break;
        //                 case 3:
        //                     $orderStatusDescription = 'Authorization has been reversed';
        //                     break;
        //                 case 4:
        //                     $orderStatusDescription = 'Transaction has been refunded';
        //                     break;
        //                 case 5:
        //                     $orderStatusDescription = 'Authorization has been initiated via the issuer’s ACS';
        //                     break;
        //                 case 6:
        //                     $orderStatusDescription = 'Authorization is declined';
        //                     break;
        //             }

        //             $order->orderStatus = $response['orderStatus'];
        //             $order->orderStatusDescription = $orderStatusDescription;
        //             $order->actionCode = $response['actionCode'];
        //             $order->actionCodeDescription = $response['actionCodeDescription'];
        //         }
        //     }
        // });

        return view('admin.orders.index', compact('orders'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');
    }

    public function status(Request $request)
    {
        $orderStatus = Order::find($request->order_id)
            ->update([
                'status' => $request->status
            ]);
    }
}
