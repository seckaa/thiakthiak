@extends('layouts.app')


@section('content')
    <h2>Checkout</h2>


    <h3>Shipping Information</h3>

    <form action="{{ route('orders.store') }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" name="shipping_fullname" id="" class="form-control">
            @error('shipping_fullname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="">State</label>
            <input type="text" name="shipping_state" id="" class="form-control">
            @error('shipping_state')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="shipping_city" id="" class="form-control">
            @error('shipping_city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Zip</label>
            <input type="number" name="shipping_zipcode" id="" class="form-control">
            @error('shipping_zipcode')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Full Address</label>
            <input type="text" name="shipping_address" id="" class="form-control">
            @error('shipping_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Mobile</label>
            <input type="text" name="shipping_phone" id="" class="form-control">
            @error('shipping_phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4>Payment option</h4>

        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" checked class="form-check-input" name="payment_method" id=""
                    value="cash_on_delivery">
                Cash on delivery

            </label>

        </div>

        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
                Paypal

            </label>

        </div>


        <button type="submit" class="btn btn-primary mt-3">Place Order</button>

    </form>
@endsection
