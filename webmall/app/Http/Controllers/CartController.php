<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
// use Darryldecode\Cart\Cart;
// use Cart;
use Illuminate\Http\Request;
use SpomkyLabs\Pki\ASN1\Component\Length;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{


    function index()
    {
        // $couponCode = request('coupon_code');

        // $couponData = Coupon::where('code', $couponCode)->first();

        $order = new Order();
        $couponData = Coupon::all();

        // if (!$couponData) {
        //     return back()->withMessage('Sorry! Coupon does not exist');
        // }

        $cartItems = \Cart::session(auth()->id())->getContent();
        if ($cartItems->isEmpty()) {
            return back();
        } else {
            // return view('cart.index', compact('cartItems'));
            return view('cart.cart', compact('cartItems', 'couponData', 'order'));
            // return view('cart.cart', compact('cartItems'));
        }
    }

    function add(Product $product)
    {
        // dd($product);
        // add the product to cart
        // dd(str_replace('\\', '/', $product->cover_img),);
        // dd($product->description);
        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('cart.index');
        // return back();
        // return back()->withMessage('item added');
    }

    public function destroy($itemId)
    {

        \Cart::session(auth()->id())->remove($itemId);

        return back();
    }

    public function update($rowId)
    {

        \Cart::session(auth()->id())->update($rowId, [
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);

        return back();
    }

    public function checkout()
    {
        return view('cart.checkout');
    }

    public function applyCoupon()
    {
        $couponCode = request('coupon_code');

        $couponData = Coupon::where('code', $couponCode)->first();

        if (!$couponData) {
            return back()->withMessage('Sorry! Coupon does not exist');
        }


        //coupon logic
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $couponData->name,
            'type' => $couponData->type,
            // 'target' => 'total', //this condition apply to subtotal when subTotal is called
            'target' => 'subtotal',
            'value' => $couponData->value,
        ));

        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart

        // $couponData->delete();

        return back()->withMessage('coupon applied');
    }


    public function applyTaxes()
    {
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 8.875%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '8.875%',
            // 'order' => 2
        ));

        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart

        // $couponData->delete();

        // return back()->withMessage('taxes applied');
    }
}
