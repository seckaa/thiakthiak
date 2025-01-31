{{-- <x-mail::message>
    # Congratulations

    Your shop is now active

    <x-mail::button :url="''">
        Visit Your Shop
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message> --}}


@component('mail::message')
    # Congratulations

    Your shop is now active



    @component('mail::button', ['url' => route('shops.show', $shop)])
        Visit Your Shop
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
