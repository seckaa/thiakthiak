@extends('layouts.front')


@section('content')
    @include('_category-list')
    <div class="container">

        <h2> {{ $categoryName ?? null }} Menu </h2>

        <div class="custom-row-2">
            {{-- {{ dd($products) }} --}}

            @foreach ($products as $product)
                @include('product._single_product')
            @endforeach

        </div>


    </div>
@endsection
