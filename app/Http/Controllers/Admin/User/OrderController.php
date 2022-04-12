<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user->load([
            'orders' => fn ($query) => $query->with('paymentType.translation')
                ->withCount('orderProducts')
                ->latest()
        ]);

//        $user->orders->each(function ($order) {
//            if ($order->payment_type_id === 3 && $order->orderOnlinePayment->bank_order_id !== null) {
//                $data = [
//                    'userName' => config('online-payment.userName'),
//                    'password' => config('online-payment.password'),
//                    'orderId' => $order->orderOnlinePayment->bank_order_id
//                ];
//
//                $response = Http::withOptions([
//                    'verify' => false,
//                ])->get('https://agn.rysgalbank.tm/epg/rest/getOrderStatusExtended.do', $data);
//
//                if ($response->successful()) {
//                    if ($response['errorCode']) {
//                        $order->errorMessage = $response['errorMessage'];
//                        return;
//                    }
//
//                    switch ($response['orderStatus']) {
//                        case 0:
//                            $orderStatusDescription = 'Order registered, but not paid';
//                            break;
//                        case 1:
//                            $orderStatusDescription = 'Preauthorization amount was put on hold (for a two-phase payment)';
//                            break;
//                        case 2:
//                            $orderStatusDescription = 'Amount was deposited successfully';
//                            break;
//                        case 3:
//                            $orderStatusDescription = 'Authorization has been reversed';
//                            break;
//                        case 4:
//                            $orderStatusDescription = 'Transaction has been refunded';
//                            break;
//                        case 5:
//                            $orderStatusDescription = 'Authorization has been initiated via the issuer’s ACS';
//                            break;
//                        case 6:
//                            $orderStatusDescription = 'Authorization is declined';
//                            break;
//                    }
//
//                    $order->orderStatus = $response['orderStatus'];
//                    $order->orderStatusDescription = $orderStatusDescription;
//                    $order->actionCode = $response['actionCode'];
//                    $order->actionCodeDescription = $response['actionCodeDescription'];
//                }
//            }
//        });

        return view('admin.users.orders.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user, Order $order)
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

        $order->load([
            'orderProducts.product.translation'
        ]);

//        if ($order->payment_type_id === 3 && $order->orderOnlinePayment->bank_order_id !== null) {
//            $data = [
//                'userName' => config('online-payment.userName'),
//                'password' => config('online-payment.password'),
//                'orderId' => $order->orderOnlinePayment->bank_order_id
//            ];
//
//            $response = Http::withOptions([
//                'verify' => false,
//            ])->get('https://agn.rysgalbank.tm/epg/rest/getOrderStatusExtended.do', $data);
//
//            if ($response->successful()) {
//                if ($response['errorCode']) {
//                    $order->errorMessage = $response['errorMessage'];
//                    return;
//                }
//
//                switch ($response['orderStatus']) {
//                    case 0:
//                        $orderStatusDescription = 'Order registered, but not paid';
//                        break;
//                    case 1:
//                        $orderStatusDescription = 'Preauthorization amount was put on hold (for a two-phase payment)';
//                        break;
//                    case 2:
//                        $orderStatusDescription = 'Amount was deposited successfully';
//                        break;
//                    case 3:
//                        $orderStatusDescription = 'Authorization has been reversed';
//                        break;
//                    case 4:
//                        $orderStatusDescription = 'Transaction has been refunded';
//                        break;
//                    case 5:
//                        $orderStatusDescription = 'Authorization has been initiated via the issuer’s ACS';
//                        break;
//                    case 6:
//                        $orderStatusDescription = 'Authorization is declined';
//                        break;
//                }
//
//                $order->orderStatus = $response['orderStatus'];
//                $order->orderStatusDescription = $orderStatusDescription;
//                $order->actionCode = $response['actionCode'];
//                $order->actionCodeDescription = $response['actionCodeDescription'];
//            }
//        }

        return view('admin.users.orders.show', compact('user', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Order $order)
    {
        $order->delete();
        return redirect()->route('admin.users.orders.index', $user->id);
    }
}
