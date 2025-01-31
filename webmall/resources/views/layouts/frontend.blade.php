<!DOCTYPE html>
<html lang="en">

{{-- Header --}}
<x-frontend.header>

</x-frontend.header>

<body>
    {{-- <body onload="requestPermission()"> --}}

    <x-frontend.navbar>

    </x-frontend.navbar>

    <main class="min-h-screen">
        {{-- {{ $slot }} --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-frontend.footer>

    </x-frontend.footer>
</body>

</html>
