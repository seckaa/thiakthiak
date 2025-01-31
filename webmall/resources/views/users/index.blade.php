<x-main.layout>
    @if (!Auth::check())
        @include('partials._hero')
        {{-- <x-main.modals /> --}}
    @endif

    @include('partials._search')


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless (count($foods) == 0)

            @foreach ($foods as $food)
                <x-main.listing-card :food="$food" />
            @endforeach
        @else
            <p>No listings found</p>
        @endunless

    </div>

    {{-- <div class="container">
        <div class="listProduct">
        </div>
    </div> --}}

    <div class="mt-6 p-4">
        {{ $foods->links() }}
    </div>

    @include('partials._carousel')
    {{-- @include('cart.index') --}}

</x-main.layout>
