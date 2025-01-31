<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="cart-main-area pt-95 pb-100">
        {{-- <h3>This is teh content {{ $textData }}</h3> --}}
        <div class="container">

            {{-- <input type="text" wire:model="textData"> --}}

            <div class="row">
                {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> --}}
                <div>

                    <h1 class="cart-heading">Cart</h1>
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>remove</th>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="product-remove">
                                            <div class=""><a href="{{ route('cart.destroy', $item['id']) }}">
                                                    <i class="pe-7s-close"></i></a></div>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="#"><img src="assets/img/cart/1.jpg" alt=""></a>
                                        </td>
                                        <td scope="row" class="product-name">{{ $item['name'] }}</td>
                                        <td class="product-price-cart"><span
                                                class="amount">${{ Cart::session(auth()->id())->get($item['id'])->getPriceSum() }}</span>
                                        </td>

                                        {{-- </td> --}}

                                        <td class="product-quantity">
                                            {{-- <form action="{{ route('cart.update', $item['id']) }}">
                                                @csrf
                                                <input name="quantity" type="number" value="{{ $item['quantity'] }}">
                                                <input type="submit" value="Save">
                                            </form> --}}
                                            <livewire:cart-update-form :item="$item" :key="$item['id']" />
                                        </td>





                                        {{-- <td class="product-price-cart"><span
                                                class="amount">${{ Cart::session(auth()->id())->get($item['id'])->getPriceSum() }}</span>
                                        </td> --}}
                                        {{-- <td class="product-quantity"> --}}
                                        {{-- <livewire:cart-update-form :item="$item" :key="$item['id']" /> --}}
                                        {{-- </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <form action="{{ route('cart.coupon') }}" method='get'>
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text" required>
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>SubTotal<span>{{ \Cart::session(auth()->id())->getSubTotal() }}</span></li>
                                    <li>Total<span>{{ \Cart::session(auth()->id())->getTotal() }}</span></li>
                                </ul>
                                <a name="" id="" class="btn btn-primary"
                                    href="{{ route('cart.checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
