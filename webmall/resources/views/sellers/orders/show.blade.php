@extends('layouts.seller')


@section('content')
    <h3>Order Summary</h3>
    <br>
    <div class="mt-1 p-1">
        Client: {{ $user->name }}
        <br>
        Address : {{ $porder->shipping_address }}
        <br>
        Phone : {{ $porder->shipping_phone }}
        <br>
        Order comments : {{ $porder['notes'] ? $porder['notes'] : 'n/a' }} <br>
        {{-- Order Payment status : {!! $porder['is_paid'] == 1 ? 'Paid' : 'Not Paid' !!} <br> --}}

        @if ($porder['is_paid'] == 1)
            <span class="text-white bg-success p-1 m-1">Paid</span>
        @else
            <span class="text-white bg-danger p-1 m-1">Not Paid</span>
        @endif
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td scope="row">
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->pivot->quantity }}
                    </td>
                    <td>
                        {{ $item->pivot->price }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
