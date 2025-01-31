<x-main.layout>
    @if (!Auth::check())
        @include('partials._hero')
    @endif

    @include('partials._search')

    <div class="">

        @include('partials._menupills')

    </div>

</x-main.layout>
