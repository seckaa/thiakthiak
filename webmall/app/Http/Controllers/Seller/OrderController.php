<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\Product;
use App\Models\SubOrder;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = SubOrder::orderBy("order_id", "desc")->where('seller_id', auth()->id())->get();
        $orders = SubOrder::orderBy("order_id", "desc")->where('seller_id', auth()->id())->paginate(5);

        return view('sellers.orders.index', compact('orders'));
    }

    public function show(SubOrder $order)
    {
        // public function show(Order $order)
        // {
        // $items = $order->items()->whereHas('shop', function ($q) {
        //     $q->where('user_id', auth()->id());
        // })->get();
        // dd($order);
        //    --------------//
        // $orderId = $order->order_id;
        // // dd($orderId);

        // $porder = Order::find($orderId);
        // $user = User::find($porder->user_id);
        // // dd($porder);
        // $items = $order->items;
        // // dd($items);
        // if ($user->id == auth()->user()->id) {

        //     return view('sellers.orders.show', compact('items', 'porder', 'user'));
        // } else {
        //     abort(403);
        // }


        // -----------//
        if (!$order->canView()) {
            abort(403);
        }
        $orderId = $order->order_id;
        // dd($orderId);

        $porder = Order::find($orderId);
        $user = User::find($porder->user_id);
        // dd($porder);
        $items = $order->items;
        // dd($items);
        return view('sellers.orders.show', compact('items', 'porder', 'user'));
    }

    public function markDelivered(SubOrder $suborder)
    {

        $suborder->status = 'completed';
        $suborder->save();

        //check if all suborders complete
        $pendingSubOrders = $suborder->order->subOrders()->where('status', '!=', 'completed')->count();

        if ($pendingSubOrders == 0) {
            $suborder->order()->update(['status' => 'completed']);
        }

        return redirect('/seller/orders')->withMessage('Order marked complete');
    }
}
