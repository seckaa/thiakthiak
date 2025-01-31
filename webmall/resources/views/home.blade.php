@extends('layouts.front')

@section('content')
    @include('_category-list')

    {{-- <div class="electronic-banner-area">
        <div class="custom-row-2">
            @include('_dummy-product')
            @include('_dummy-product')
            @include('_dummy-product')
        </div>
    </div> --}}

    <div class="electro-product-wrapper wrapper-padding pt-95 pb-45">
        <div class="container-fluid">
            <div class="section-title-4 text-center mb-40">
                <h2>Top Foods</h2>
            </div>

            <div class="top-product-style">
                <div>
                    <div id="electro1">
                        <div class="custom-row-2">
                            @foreach ($allProducts as $product)
                                @include('product._single_product')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection















{{-- ---------------------using app layout --}}
{{-- @extends('layouts.app')

@section('content')
    <div class="container"> --}}

{{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

{{-- <h2 class="">Product</h2>
        <div class="row">
            @foreach ($allProducts as $product)
                <div class="col-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('default.png') }}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p class="card-text">{{ $product->description }}</p>
                            <h3 class="card-title">${{ $product->price }}</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('cart.add', $product->id) }}" class="card-link">Add to cart</a> --}}

{{-- <a href="#" class="card-link">Another link</a> --}}
{{-- <a href="/add-to-cart/{{ $product->id }}" class="card-link">Add to cart</a> --}}

{{-- </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection --}}
