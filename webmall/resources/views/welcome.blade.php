@extends('layouts.frontend')

@section('content')
    <x-frontend.body :foods="$allProducts">

    </x-frontend.body>
    {{-- <x-frontend-layout> --}}
    {{-- </x-frontend-layout> --}}
@endsection
