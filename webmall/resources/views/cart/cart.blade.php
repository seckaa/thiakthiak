<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <style>
        @charset "utf-8";

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700,600);

        html,
        html a {
            -webkit-font-smoothing: antialiased;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
        }

        body {
            background-color: #fff;
            color: #666;
            font-family: 'Open Sans', sans-serif;
            font-size: 62.5%;
            margin: 0 auto;
        }

        a {
            border: 0 none;
            outline: 0;
            text-decoration: none;
        }

        strong {
            font-weight: bold;
        }

        p {
            margin: 0.75rem 0 0;
        }

        h1 {
            font-size: 0.75rem;
            font-weight: normal;
            margin: 0;
            padding: 0;
        }

        input,
        button {
            border: 0 none;
            outline: 0 none;
        }

        button {
            background-color: #666;
            color: #fff;
        }

        button:hover,
        button:active,
        button:focus {
            background-color: #555;
        }

        img,
        .basket-module,
        .basket-labels,
        .basket-tipncom,
        .basket-product {
            width: 100%;
        }

        input,
        button,
        .basket,
        .basket-module,
        .basket-labels,
        .basket-tipncom,
        .item,
        .price,
        .quantity,
        .subtotal,
        .basket-product,
        .product-image,
        .product-details {
            float: left;
        }

        .price:before,
        .subtotal:before,
        .tip:before,
        .tax:before,

        .subtotal-value:before,
        .tip-value:before,
        .tax-value:before,
        .total-value:before,
        .promo-value:before {
            /* content: '£'; */
            content: '$';
        }

        .hide {
            display: none;
        }

        main {
            clear: both;
            font-size: 0.75rem;
            margin: 0 auto;
            overflow: hidden;
            padding: 1rem 0;
            width: 960px;
        }

        .basket,
        aside {
            padding: 0 1rem;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .basket {
            width: 70%;
        }

        .basket-module {
            color: #111;
        }

        label {
            display: block;
            margin-bottom: 0.3125rem;
        }

        .promo-code-field {
            border: 1px solid #ccc;
            padding: 0.5rem;
            text-transform: uppercase;
            transition: all 0.2s linear;
            width: 48%;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -o-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }

        .promo-code-field:hover,
        .promo-code-field:focus {
            border: 1px solid #999;
        }

        .form-field {
            border: 1px solid #ccc;
            padding: 0.5rem 0 0 0.5rem;
            /* text-transform: uppercase; */
            transition: all 0.2s linear;
            /* width: 100%; */
            /* width: 48%; */
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -o-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            margin: 0 0 1rem 0;
            resize: none;
            /* margin: 5px 10px 5px 10px; */
            border-radius: 8px;
            width: 98%;
        }

        .form-field:hover,
        .form-field:focus {
            border: 1px solid #999;
        }

        .tnc-area {
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
            position: relative;
        }

        .btn-group {
            display: flex;
            justify-content: space-evenly;
            /* padding: 1rem 0; */
            position: relative;
            width: 100%;
            gap: 5px;
        }

        .tip {
            /* margin: 1rem 0; */
            padding: 1rem;
            border: 1px solid #ccc;

            background-color: #fff;
            color: #666;

            width: 20%;

            margin: 1rem 0;
            resize: none;
            /* margin: 5px 10px 5px 10px; */
            border-radius: 8px;
            /* display: flex;
            justify-content: center;
            align-items: center; */

            text-align: center;
        }

        .tip:hover,
        .tip:active {
            font-weight: bold;
            background-color: #aaa;
            color: #8B0000;
        }

        .tip-active {
            color: white;
            background-color: #8B0000;
            border: 1px solid #8B0000;
        }

        .tip-default {
            color: white;
            background-color: #8B0000;
            /* background-color: #c6aa76; */
        }

        .tip-active:hover,
        .tip-active:active {
            color: white;
        }

        .basket-tipncom {
            padding: 0.5rem 0;
            position: relative;
            /* border: 1px solid red; */
        }

        .comment-field {
            border: 1px solid #ccc;
            padding: 0.5rem 0 0 0.5rem;
            /* text-transform: uppercase; */
            transition: all 0.2s linear;
            /* width: 100%; */
            /* width: 48%; */
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -o-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            margin: 0 0 1rem 0;
            resize: none;
            /* margin: 5px 10px 5px 10px; */
            border-radius: 8px;
            width: 98%;
        }

        .comment-field:hover,
        .comment-field:focus {
            border: 1px solid #999;
        }

        .promo-code-cta {
            border-radius: 4px;
            font-size: 0.625rem;
            margin-left: 0.625rem;
            padding: 0.6875rem 1.25rem 0.625rem;
        }

        .basket-labels {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            margin-top: 1.625rem;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li {
            color: #111;
            display: inline-block;
            padding: 0.625rem 0;
        }

        li.price:before,
        li.subtotal:before {
            content: '';
        }

        .item {
            width: 55%;
        }

        .price,
        .quantity,
        .subtotal {
            width: 15%;
        }

        .subtotal {
            text-align: right;
        }

        .remove {
            bottom: 1.125rem;
            float: right;
            position: absolute;
            right: 0;
            text-align: right;
            width: 45%;
            /* border: 1px solid #bbb; */
            /* border-radius:8px;*/
        }

        .remove button {
            background-color: transparent;
            color: #777;
            float: none;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .item-heading {
            padding-left: 4.375rem;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .basket-product {
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
            position: relative;
        }

        .product-image {
            width: 35%;
        }

        .product-details {
            width: 65%;
        }

        .product-frame {
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        .product-details {
            padding: 0 1.5rem;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .quantity-field {
            background-color: #ccc;
            border: 1px solid #aaa;
            border-radius: 4px;
            font-size: 0.625rem;
            padding: 2px;
            width: 3.75rem;
            text-align: center;
        }

        aside {
            float: right;
            position: relative;
            width: 30%;
        }

        .summary {
            background-color: #eee;
            border: 1px solid #aaa;
            padding: 1rem;
            /* position: fixed; */
            width: 250px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .summary-total-items {
            color: #666;
            font-size: 0.875rem;
            text-align: center;
        }

        .summary-subtotal,
        .summary-total {
            border-top: 1px solid #ccc;
            /* border-bottom: 1px solid #ccc; */
            clear: both;
            margin: 1rem 0;
            overflow: hidden;
            padding: 0.5rem 0;
        }

        .subtotal-title,
        .tip-title,
        .tax-title,
        .subtotal-value,
        .tip-value,
        .tax-value,
        .total-title,
        .total-value,
        .promo-title,
        .promo-value {
            color: #111;
            float: left;
            width: 50%;
        }

        .summary-promo {
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        .promo-title {
            float: left;
            width: 70%;
        }

        .promo-value {
            color: #8B0000;
            float: left;
            text-align: right;
            width: 30%;
        }

        .summary-delivery {
            padding-bottom: 1rem;
        }

        .subtotal-value,
        .tip-value,
        .tax-value,
        .total-value {
            text-align: right;
        }

        .total-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .summary-checkout {
            display: block;
        }

        .checkout-cta {
            display: block;
            float: none;
            font-size: 0.75rem;
            text-align: center;
            text-transform: uppercase;
            padding: 0.625rem 0;
            width: 100%;
            margin-bottom: 10px;
        }

        .back-cta {
            display: block;
            float: none;
            font-size: 0.75rem;
            text-align: center;
            text-transform: uppercase;
            padding: 0.625rem 0;
            width: 100%;
            margin-bottom: 10px;
            background-color: #8B0000;
        }

        .summary-delivery-selection {
            background-color: #ccc;
            border: 1px solid #aaa;
            border-radius: 4px;
            display: block;
            font-size: 0.625rem;
            height: 34px;
            width: 100%;
        }

        @media screen and (max-width: 640px) {

            .comment-field {
                /* width: 85vw; */
                width: 98%;
            }

            .form-field {
                width: 98%;
            }

            aside,
            /* .comment-field, */
            /* .form-field, */
            .basket,
            .summary,
            .item,
            .remove {
                width: 100%;
            }

            .basket-labels {
                display: none;
            }

            .basket-module {
                margin-bottom: 1rem;
            }

            .item {
                margin-bottom: 1rem;
            }

            .product-image {
                width: 40%;
            }

            .product-details {
                width: 60%;
            }

            .price,
            .subtotal {
                width: 33%;
            }

            .quantity {
                text-align: center;
                width: 34%;
            }

            .quantity-field {
                float: none;
            }

            .remove {
                bottom: 0;
                text-align: left;
                margin-top: 0.75rem;
                /* margin-bottom: 0.75rem; */
                position: relative;
            }

            .remove button {
                padding: 0;
            }

            .summary {
                margin-top: 1.25rem;
                position: relative;
            }
        }

        @media screen and (min-width: 641px) and (max-width: 960px) {
            aside {
                padding: 0 1rem 0 0;
            }

            .summary {
                /* width: 28%; */
                width: 100%;

            }
        }

        @media screen and (max-width: 960px) {
            main {
                width: 100%;
            }

            .product-details {
                padding: 0 1rem;
            }

        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>

<body>
    @if (sizeof($cartItems) > 0)
        {{-- here --}}

        <main>
            <div class="basket">
                <div class="basket-module">
                    <label for="promo-code">Enter a promotional code</label>
                    <input id="promo-code" type="text" name="promo-code" class="promo-code-field">
                    <button class="promo-code-cta">Apply</button>
                </div>
                <div class="basket-labels">
                    <ul>
                        <li class="item item-heading">Item</li>
                        <li class="price">Price</li>
                        <li class="quantity">Quantity</li>
                        <li class="subtotal">Subtotal</li>
                    </ul>
                </div>

                {{-- <!-- --}}
                @foreach ($cartItems as $item)
                    <div class="basket-product">

                        <div class="item">
                            <div class="product-image">
                                <img src="{{ $item->associatedModel->cover_img ? asset('storage/' . $item->associatedModel->cover_img) : asset('/no-image.png') }}"
                                    alt="{{ $item->name }}" class="product-frame">
                            </div>
                            <div class="product-details">
                                <h1><strong><span class="item-quantity">
                                            {{-- 1</span> x Whistles --}}
                                    </strong> {{ $item->name }}
                                </h1>
                                <p><strong> </strong> {!! $item->associatedModel->description !!}</strong></p>
                                {{-- <p>Product Code - 232321939</p> --}}
                            </div>
                        </div>

                        <div class="price"> {{ $item['price'] }}.00</div>
                        <div class="quantity">
                            {{-- <input type="number" value="{{ $item->quantity }}" min="1" class="quantity-field"> --}}
                            <livewire:cart-update-form :item="$item" :key="$item['id']" />
                        </div>
                        <div class="subtotal">{{ Cart::session(auth()->id())->get($item['id'])->getPriceSum() }}.00
                        </div>
                        {{-- <div class="subtotal">110.00
                        </div> --}}
                        {{-- <div class="remove">
                        <button>
                            <a href="{{ route('cart.destroy', $item['id']) }}" class="">

                                Remove</button>
                    </div> --}}

                        <div class="remove">
                            <input type="hidden" id="{{ $item->name }}" value="{{ $item['id'] }}" />
                            <button>Remove</button>
                        </div>

                    </div>
                @endforeach
                {{-- --> --}}


                <div class="basket-tipncom">
                    <div class="tnc-area">
                        {{-- <textarea row="3" cols="auto" id="comment" aria-label="order instructions" name="notes"
                            placeholder="Special instructions, requests or add ons..." class="comment-field"></textarea> --}}
                        <div><label>Tips</label></div>
                        {{-- <div class="tips">
                            <div class="tip">none</div>
                            <div class="tip">12%</div>
                            <div class="tip">15%</div>
                            <div class="tip">20%</div>
                        </div> --}}

                        <div class="btn-group" id="group1" data-group="1">
                            <button type="button" value="0" class="tip" onclick="switch_to_active(this)">none
                            </button>
                            <button type="button" value="12" class="tip" onclick="switch_to_active(this)">
                                12%
                            </button>
                            <button type="button" value="15" id="tip-default" class="tip tip-default"
                                onclick="switch_to_active(this)">15%
                            </button>
                            <button type="button" value="20" class="tip" onclick="switch_to_active(this)">20%
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <aside>

                <div class="summary">

                    <form action="{{ route('orders.store') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="summary-delivery">
                            <select name="delivery-collection" class="summary-delivery-selection" id="group2"
                                data-group="2" {{-- onchange="pickup_delivery_option()" --}}>
                                {{-- <option value="0" selected="selected">Select PickUp or Delivery</option> --}}
                                <option value="collection">PickUp</option>
                                <option value="first-class">Delivery(free)</option>
                                {{-- <option value="second-class">Royal Mail 2nd Class</option>
                        <option value="signed-for">Royal Mail Special Delivery</option> --}}
                            </select>
                        </div>
                        <textarea row="3" cols="auto" id="comment" aria-label="order instructions" name="notes"
                            placeholder="Special instructions, requests or add on..." class="comment-field"></textarea>

                        <div class="summary-info" id="summary-info">
                            <label for="promo-code">Your info:</label>
                            <input id="fname" type="text" name="fname" placeholder="*First Name.."
                                class="form-field">
                            <input id="lname" type="text" name="lname" placeholder="*Last Name.."
                                class="form-field">
                            <input id="phone" type="text" name="shipping_phone" placeholder="*Phone.."
                                class="form-field">
                            <input id="email" type="text" name="email" placeholder="*Email.."
                                class="form-field">

                            <div class="ml-2 mt-2 d-inline-flex align-items-center"><input id="texting-permission"
                                    type="checkbox" checked="checked" class="mr-3"> <label
                                    for="texting-permission"
                                    class="mb-0 font-weight-bold d-inline-block texting-permission-label">
                                    <div>
                                        &nbsp; I'd like to get texts about specials, events, and other exclusive offers
                                        and
                                        announcements
                                        not available to
                                        the general public.
                                        <a href="#" target="_blank">
                                            Privacy Policy
                                        </a> <a href="#" target="_blank">
                                            Terms and Conditions
                                        </a>
                                        <ul>
                                            <li>Message and data rates may apply.</li>
                                            <li>Message frequency varies.</li>
                                        </ul>
                                    </div>
                                </label></div> <!---->
                        </div>

                        <div class="summary-address" id="summary-address"> <label for="promo-code">Delivery
                                Info:</label>
                            <input id="address" type="text" name="shipping_address" placeholder="Address.."
                                class="form-field">
                            <input id="apt" type="apt" name="apt" placeholder="*Apt#.."
                                class="form-field">
                            <input id="shipping-city" type="text" name="shipping_city" placeholder="*City.."
                                class="form-field">
                            <input id="shipping-state" type="text" name="shipping_state" placeholder="*State.."
                                class="form-field">
                            <input id="shipping-zipcode" type="text" name="shipping_zipcode"
                                placeholder="*ZipCode.." class="form-field">


                        </div>

                        <div class="summary-order-info">

                            <p class="font-weight-bold mb-1 mt-3">Order Information:</p>
                            <div>&nbsp;</div>
                            <div class="summary-total-items"><span class="total-items"></span> Item(s)
                                in your Bag</div>
                            <div class="d-flex flex-column order-time-holder border-bottom">
                                <div>
                                    <p class="mb-1">
                                        This order will be ready in
                                        <span>
                                            30 minutes
                                        </span>
                                        .
                                    </p>
                                </div>
                                <p>
                                    To place an order at a different time, please start a
                                    <span tabindex="0" class="new-order-link">
                                        new order
                                    </span> <span class="d-none">start here</span>
                                </p>
                            </div>

                        </div>

                        <div class="summary-subtotal">
                            <?php
                            // $cartItems = \Cart::session(auth()->id())->getContent();
                            $subTotal = \Cart::session(auth()->id())->getSubTotal();
                            // $total = \Cart::session(auth()->id())->getTotal();
                            $tax = round(($subTotal * 8.875) / 100, 2);
                            $tip = round(($subTotal * 15) / 100, 2);
                            $ttotal = round($subTotal + $tax + $tip, 2);
                            ?>

                            <div class="tax-title">Tax :</div>
                            <input type="hidden" name="taxes" value="{{ $order->tax }}" id="taxes">

                            <div class="tax-value final-value" value="{{ $order->tax }}" name="tax"
                                id="basket-tax">
                                {{-- {{ (\Cart::session(auth()->id())->getSubTotal() * 8.875) / 100 }} --}}
                                {{ $tax }}
                            </div>
                            <div class="tip-title">Tip :</div>
                            <input type="hidden" name="tip" id="tip">
                            <div class="tip-value final-value" name="tips" id="basket-tip">
                                {{-- {{ (\Cart::session(auth()->id())->getSubTotal() * 15) / 100 }} --}}
                                {{ $tip }}
                            </div>

                            <div class="subtotal-title">Subtotal :</div>
                            <input type="hidden" name="sub_total" id="sub_total">
                            <div class="subtotal-value final-value" id="basket-subtotal">
                                {{-- {{ \Cart::session(auth()->id())->getSubTotal() }}.00 --}}
                                {{ $subTotal }}
                            </div>
                            <div class="summary-promo hide">
                                <div class="promo-title">Promotion :</div>
                                <input type="hidden" name="promo" id="promo">
                                <div class="promo-value final-value" id="basket-promo"></div>
                            </div>
                        </div>

                        <div class="summary-total">
                            <div class="total-title">Total :</div>
                            <input type="hidden" name="grand_total" value="" id="grand_total">
                            <div class="total-value final-value" name="ttotal" id="basket-total">
                                {{ $ttotal }}</div>
                        </div>

                        <input type="hidden" name="note" value="" id="note">

                        <div><!---->
                            <div>
                                <p class="font-weight-bold">
                                    PAYMENT WILL BE COLLECTED WHEN YOU RECEIVE YOUR ORDER</p>
                            </div>
                        </div>

                        {{-- <div class="summary-checkout">
                        <button class="back-cta" id="back-cta"> Back</button>
                        @if (sizeof($cartItems) > 0)
                            <button class="checkout-cta">Secure
                                Checkout</button>
                        @else
                        @endif

                    </div> --}}
                        <div>
                            <h4>Payment option</h4>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" checked class="form-check-input" name="payment_method"
                                        id="" value="cash_on_delivery">
                                    Cash on delivery

                                </label>

                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="payment_method"
                                        id="" value="paypal">
                                    Paypal

                                </label>

                            </div>

                            <div>&nbsp;</div>

                            {{-- <div class="summary-checkout">
                                <button class="back-cta" id="back-cta">
                                    back</button>
                                @if (sizeof($cartItems) > 0)
                                    <button class="checkout-cta">Secure
                                        Checkout</button>
                                @else
                                @endif

                            </div> --}}

                            <div class="summary-checkout">
                                @if (sizeof($cartItems) > 0)
                                    <button class="checkout-cta">Secure
                                        Checkout</button>
                                @else
                                @endif

                            </div>

                        </div>
                    </form>
                    <div class="summary-checkout">
                        <button class="back-cta" id="back-cta">
                            back</button>

                    </div>
                </div>

            </aside>
            {{-- here --}}


        </main>
    @else
        Your cart is emtpty
    @endif

    <!-- partial -->
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script>
        /* Set values + misc */
        var promoCode;
        var promoPrice;
        var fadeTime = 300;

        /* Assign actions */
        $('.quantity input').change(function() {
            updateQuantity(this);
        });

        $('.remove button').click(function() {
            removeItem(this);
        });

        $(document).ready(function() {
            updateSumItems();
        });


        $('.promo-code-cta').click(function() {

            promoCode = $('#promo-code').val();

            if (promoCode == '10off' || promoCode == '10OFF') {
                //If promoPrice has no value, set it as 10 for the 10OFF promocode
                if (!promoPrice) {
                    promoPrice = 10;
                } else if (promoCode) {
                    promoPrice = promoPrice * 1;
                }
            } else if (promoCode != '') {
                alert("Invalid Promo Code");
                promoPrice = 0;
            }
            //If there is a promoPrice that has been set (it means there is a valid promoCode input) show promo
            if (promoPrice) {
                $('.summary-promo').removeClass('hide');
                $('.promo-value').text(promoPrice.toFixed(2));
                recalculateCart(true);
            }
        });

        // $(".checkout-cta").click(function() {
        //     // window.location.href = "/cart/checkout";
        //     // checkout();

        // });

        $(".back-cta").click(function() {
            // window.location.href = "http://127.0.0.1:8000/shopping";
            // history.go(-1);

            window.location.href = "/shopping";

        });

        /* Recalculate cart */
        function recalculateCart(onlyTotal) {
            var subtotal = 0;


            /* Sum up row totals */
            $('.basket-product').each(function() {
                subtotal += parseFloat($(this).children('.subtotal').text());
            });

            /* Calculate totals */

            var tipv = 15;


            if ($('.tip-active').val()) {

                tipv = $('.tip-active').val();
            }




            var tip = subtotal * tipv / 100;
            var tax = subtotal * 0.0875;

            var total = subtotal + tip + tax;

            //If there is a valid promoCode, and subtotal < 10 subtract from total
            var promoPrice = parseFloat($('.promo-value').text());
            if (promoPrice) {
                if (subtotal >= 10) {
                    total -= promoPrice;
                } else {
                    alert('Order must be more than $10 for Promo code to apply.');
                    $('.summary-promo').addClass('hide');
                }
            }

            /*If switch for update only total, update only total display*/
            if (onlyTotal) {
                /* Update total display */
                $('.total-value').fadeOut(fadeTime, function() {
                    $('#basket-total').html(total.toFixed(2));
                    $('.total-value').fadeIn(fadeTime);

                    updateDetails();
                });
            } else {
                /* Update summary display. */
                $('.final-value').fadeOut(fadeTime, function() {
                    $('#basket-subtotal').html(subtotal.toFixed(2));
                    $('#basket-total').html(total.toFixed(2));
                    $('#basket-tip').html(tip.toFixed(2));
                    $('#basket-tax').html(tax.toFixed(2));



                    if (total == 0) {
                        $('.checkout-cta').fadeOut(fadeTime);
                    } else {
                        $('.checkout-cta').fadeIn(fadeTime);
                    }
                    $('.final-value').fadeIn(fadeTime);

                    updateDetails();
                });
            }


        }

        /* Update quantity */
        function updateQuantity(quantityInput) {
            /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children('.price').text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;

            /* Update line price display and recalc cart totals */
            productRow.children('.subtotal').each(function() {
                $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });

            productRow.find('.item-quantity').text(quantity);
            updateSumItems();
        }

        function updateSumItems() {
            var sumItems = 0;
            $('.quantity input').each(function() {
                sumItems += parseInt($(this).val());
            });
            $('.total-items').text(sumItems);
        }

        /* Remove item from cart */
        function removeItem(removeButton) {
            //daryl not working
            // removeFromCart();

            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                // removeFromCart();
                productRow.remove();
                recalculateCart();
                updateSumItems();


            });
        }
        //daryl
        function removeFromCart() {
            // <a href="{{ route('cart.destroy', $item['id']) }}">

            // var itemId = {!! $item['id'] !!};

            var itemId = ({!! $item['id'] !!});

            var url = '/cart/destroy/' + itemId;
            // var data = [];
            console.log(url);

            $.ajax({
                type: "GET",
                url: url,
                // beforeSend: function(xhr) {
                //     xhr.setRequestHeader(csrfHeaderName, csrfValue);
                // }
                // data: JSON.stringify(data),
                // success: "success",
                // dataType: "json",
            }).done(function(response) {
                console.log("deleted");
                itemId = "";
            }).fail(function() {
                // alert("error");
                history.go(-1);
            });
        }



        // update tip
        // function updateTip() {
        //     console.log("update tip");


        //     recalculateCart();
        // }

        function checkout() {

            let details = {
                name: 'John Doe',
                city: 'Mumbai',
                status: 'Payment done'
            };

            $.ajax({
                type: "POST",
                url: "/cart/checkout",
                // data: JSON.stringify({
                //     "var_name": 120.00
                // }),
                // url: {!! route('cart.checkout') !!},
                data: JSON.stringify(details),
                contentType: "application/json",
                success: "success",
            });
            //  done(function(response) {
            //     alert('Success: ' + JSON.stringify(response));
            //     // Redirect to the response URL
            //     window.location.replace(response.url);
            // }).fail(function(xhr, ajaxOps, error) {
            //     console.log('Failed: ' + error);
            // });
        }

        function updateDetails() {

            // subtotal
            let sub_total = $('#basket-subtotal').text();
            $('#sub_total').val(sub_total);

            //total
            let grand_total = $('#basket-total').text();
            $('#grand_total').val(grand_total);

            // promo
            let promo = $('#basket-promo').text();
            $('#promo').val(promo);

            //tip
            let tips = $('#basket-tip').text();
            $('#tip').val(tips);
            // console.log(tips);

            //tax

            let tax = $('#basket-tax').text();
            $('#taxes').val(tax);

            //comment
            // let notes = $('#comment').text();
            // $('#note').val(notes);

        }
    </script>

    <script>
        window.addEventListener("load", (event) => {
            console.log("page is fully loaded");
            // productId1 = {!! str_replace("'", "\'", json_encode($cartItems)) !!};
            // couponData = {!! json_encode($couponData) !!};
            // console.log(productId['51'].associatedModel.cover_img);
            // console.log(productId['51'].associatedModel.description);
            // console.log(couponData);

            // var couponData = {!! json_encode($couponData) !!};
            // console.log(couponData);
            // var promoName;
            // // promoName = jQuery.inArray(promoCode, myPromos);
            // // console.log(promoName);

            // if (couponData) {
            //     for (let i = 0; i < couponData.length; i++) {
            //         promoName = couponData[i].code;
            //         console.log(promoName);

            //         promoValue = couponData[i].value;
            //         console.log(promoValue);
            //     }
            // }

            window.sessionStorage;
            sessionStorage.setItem("test", "1");
            console.log(sessionStorage.getItem('test'));

            delivery_value();

            updateSumItems();

            recalculateCart();
            // tip_value();
        });

        // change tip value
        function switch_to_active(el) {

            if (el.parentElement.getAttribute("data-group") == 1) {
                let tips = document.querySelectorAll('#group1 .tip');
                // let comment = document.querySelector('.comment-field').value;
                // console.log(tips);
                for (let i = 0; i < tips.length; i++) {
                    if (tips[i].classList != null) {
                        tips[i].classList.remove('tip-active');
                        tips[i].classList.remove('tip-default');
                    }
                }

                delivery_value();

                // console.log(el);
                console.log(el.value);
                // console.log(comment);

                el.classList.add('tip-active');


                //update tax n tip
                recalculateCart();
            }



        }

        // change delivery value
        function pickup_delivery_option() {
            // const sb = document.getElementByName('delivery-collection')[0].options[0].value;
            // const option = $("#group2 option:selected").text;
            // console.log(option);
            delivery_value();
            // tip_value();
        }

        // $("#group2").on('change', function() {
        // $("#group2").change(function() {
        // console.log($(this).find("option:selected").text() + 'clicked!');
        // console.log($(this).find("option:selected").text());
        // });

        $("#group2").on('change', function() {
            delivery_value();
        });

        function tip_value() {
            var e = $("#tip-default");
            console.log(e.val());
        }
        // get delivery value
        function delivery_value() {
            var e = $("#group2 :selected");
            console.log(e.val());

            if (e.val() == "collection") {
                console.log("hide");

                $("#summary-address").css({
                    display: "none",
                });
            } else {
                $("#summary-address").css({
                    display: "grid",
                });
            }
        }
    </script>


</body>

</html><!--
