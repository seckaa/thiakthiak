@component('mail::message')
    # Shop activation request

    Please activate shop. Here are shop details.

    Shop Name : {{ $shop->name }}
    Shop Owner : {{ $shop->owner->name }}

    @component('mail::button', ['url' => url('/admin/shops')])
        Manage Shops
    @endcomponent

    If you did not create an account, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent



{{-- <x-mail::message>
# Introduction
# Shop activation request


The body of your message.
Please activate shop. Here are shop details.

Shop Name : {{ $shop->name }}
Shop Owner : {{ $shop->owner->name }}

<x-mail::button :url="''">
Button Text
Manage Shops
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}
