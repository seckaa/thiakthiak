<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Jobs\MonitorOrder;
use App\Mail\OrderPaid;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class OrderController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    public function get_new_order(Request $request)
    {
        $res = Order::orderBy("id", "desc")->first();

        // dd($res);

        if (empty($res)) {
            return response()->json(["code" => -1], 200);
        }
        $id = $res->id;
        $order_new_id = cache()->get("order_new_id");

        if (empty($order_new_id)) {
            cache()->put("order_new_id", $id);
            return response()->json(["code" => -1], 200);
        }

        if ($order_new_id < $id) {
            cache()->put("order_new_id", $id);
            return response()->json(["code" => 0, "data" => $id], 200);
        } else {
            cache()->put("order_new_id", $id);
        }
        return response()->json(["code" => -1, "data" => $order_new_id], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');

        if (request('delivery-collection') == 'collection') {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'email' => 'required | email',
                'shipping_phone' => 'required',
                'payment_method' => 'required',
            ]);
            $order->shipping_state = 'bar';
            $order->shipping_city = 'bar';
            $order->shipping_address = 'bar';
            $order->shipping_zipcode = 'bar';

            if (!$request->has('billing_fullname')) {
                $order->billing_fullname = $request->input('fname') . ' ' . $request->input('lname');
                $order->billing_state = 'bar';
                $order->billing_city = 'bar';
                $order->billing_address = 'bar';
                $order->billing_phone = $request->input('shipping_phone');
                $order->billing_zipcode = 'bar';
            } else {
                $order->billing_fullname = $request->input('fname') . ' ' . $request->input('lname');
                $order->billing_state = 'bar';
                $order->billing_city = 'bar';
                $order->billing_address = 'bar';
                $order->billing_phone = $request->input('billing_phone');
                $order->billing_zipcode = 'bar';
            }
        } else {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'email' => 'required | email',
                'shipping_state' => 'required',
                'shipping_city' => 'required',
                'shipping_address' => 'required',
                'shipping_phone' => 'required',
                'shipping_zipcode' => 'required',
                'payment_method' => 'required',
            ]);

            $order->shipping_state = $request->input('shipping_state');
            $order->shipping_city = $request->input('shipping_city');
            $order->shipping_address = $request->input('shipping_address');
            $order->shipping_zipcode = $request->input('shipping_zipcode');

            if (!$request->has('billing_fullname')) {
                $order->billing_fullname = $request->input('fname') . ' ' . $request->input('lname');
                $order->billing_state = $request->input('shipping_state');
                $order->billing_city = $request->input('shipping_city');
                $order->billing_address = $request->input('shipping_address');
                $order->billing_phone = $request->input('shipping_phone');
                $order->billing_zipcode = $request->input('shipping_zipcode');
            } else {
                $order->billing_fullname = $request->input('fname') . ' ' . $request->input('lname');
                $order->billing_state = $request->input('billing_state');
                $order->billing_city = $request->input('billing_city');
                $order->billing_address = $request->input('billing_address');
                $order->billing_phone = $request->input('billing_phone');
                $order->billing_zipcode = $request->input('billing_zipcode');
            }
        }

        $order->shipping_fullname = $request->input('fname') . ' ' . $request->input('lname');
        $order->shipping_phone = $request->input('shipping_phone');


        // dd($order);

        $order->grand_total =  $request->input('grand_total');
        // dd($order->grand_total);

        $order->tips = $request->input('tip');
        $order->notes = $request->input('notes');
        $order->is_collection = $request->input('delivery-collection');
        $order->tax = $request->input('taxes');

        $order->sub_total = $request->input('sub_total');
        // $order->sub_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        $order->user_id = auth()->id();

        // dd($order);
        if (request('payment_method') == 'paypal') {
            $order->payment_method = 'paypal';
        }


        $order->save();

        // save order items

        $cartItems = \Cart::session(auth()->id())->getContent();

        foreach ($cartItems as $item) {
            $order->items()->attach($item->id, ['price' => $item->price, 'quantity' => $item->quantity]);
        }

        // dd('order created', $order);

        $order->generateSubOrders();

        // empty cart

        \Cart::session(auth()->id())->clear();


        // payment
        if (request('payment_method') == 'paypal') {

            MonitorOrder::dispatch($order)->delay(now()->addMinutes(1));

            return redirect()->route('paypal.checkout', $order->id);
        }




        // send email to sub
        if (request('payment_method') == 'cash_on_delivery') {

            Mail::to($order->user->email)->send(new OrderPaid($order));
        }

        //send event to admin not working
        // Dispatch the event
        // event(new \TCG\Voyager\Events\BreadDataAdded($order));

        // return redirect()->route('voyager.orders.index');

        // // Take user to home page
        return redirect()->route('home')->withMessage('Order has been placed');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Order $order)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Order $order)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateOrderRequest $request, Order $order)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Order $order)
    // {
    //     //
    // }
}
