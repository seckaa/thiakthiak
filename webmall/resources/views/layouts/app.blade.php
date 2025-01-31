<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/appblade.css') }}" rel="stylesheet">

    <!-- Scripts tailwindcss nice menu-->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- logo-->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @can('seller')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shops.create') }}">Add Your Shop</a>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mr-2">
                            <a class="nav-link p-0 m-0 relative" href="{{ route('cart.index') }}">
                                <i class="fas fa-cart-arrow-down text-success fa-2x"></i>
                                <div class="badge badge-danger absolute ">
                                    @auth
                                        {{ Cart::session(auth()->id())->getContent()->count() }}
                                    @else
                                        0
                                    @endauth
                                </div>
                            </a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <!-- display success message -->
        @if (session()->has('message'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <!-- display error message -->

        @if (session()->has('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- <nav class="slidemenu">

        <!-- Item 1 -->
        <input type="radio" name="slideItem" id="slide-item-1" class="slide-toggle" checked />
        <label for="slide-item-1">
            <p class="icon">♬</p><span>Home</span>
        </label>

        <!-- Item 2 -->
        <input type="radio" name="slideItem" id="slide-item-2" class="slide-toggle" />
        <label for="slide-item-2">
            <p class="icon">★</p><span>About</span>
        </label>

        <!-- Item 3 -->
        <input type="radio" name="slideItem" id="slide-item-3" class="slide-toggle" />
        <label for="slide-item-3">
            <p class="icon">✈</p><span>Folio</span>
        </label>

        <!-- Item 4 -->
        <input type="radio" name="slideItem" id="slide-item-4" class="slide-toggle" />
        <label for="slide-item-4">
            <p class="icon">✎</p><span>Blog</span>
        </label>

        <div class="clear"></div>

        <!-- Bar -->
        <div class="slider">
            <div class="bar"></div>
        </div>


        * {
        margin: 0;
        padding: 0;
        }

        .clear {
        clear: both;
        }

        .slide-toggle {
        display: none;
        }

        .slidemenu {
        font-family: arial, sans-serif;
        max-width: 600px;
        margin: 50px auto;
        overflow: hidden;
        }

        .slidemenu label {
        width: 25%;
        text-align: center;
        display: block;
        float: left;
        color: #333;
        opacity: 0.2;
        }

        .slidemenu label:hover {
        cursor: pointer;
        color: #666;
        }

        .slidemenu label span {
        display: block;
        padding: 10px;
        }

        .slidemenu label .icon {
        font-size: 20px;
        border: solid 2px #333;
        text-align: center;
        height: 50px;
        width: 50px;
        display: block;
        margin: 0 auto;
        line-height: 50px;
        border-radius: 50%;
        }

        /*Bar Style*/

        .slider {
        width: 100%;
        height: 5px;
        display: block;
        background: #ccc;
        margin-top: 10px;
        border-radius: 5px;
        }

        .slider .bar {
        width: 25%;
        height: 5px;
        background: #333;
        border-radius: 5px;
        }

        /*Animations*/
        .slidemenu label,
        .slider .bar {
        transition: all 500ms ease-in-out;
        -webkit-transition: all 500ms ease-in-out;
        -moz-transition: all 500ms ease-in-out;
        }

        /*Toggle*/

        .slidemenu .slide-toggle:checked + label {
        opacity: 1;
        }

        .slidemenu #slide-item-1:checked ~ .slider .bar {
        margin-left: 0;
        }
        .slidemenu #slide-item-2:checked ~ .slider .bar {
        margin-left: 25%;
        }
        .slidemenu #slide-item-3:checked ~ .slider .bar {
        margin-left: 50%;
        }
        .slidemenu #slide-item-4:checked ~ .slider .bar {
        margin-left: 75%;
        }

        /* --------- */
        html,
        body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        }

        #menu {
        position: absolute;
        top: 30px;
        left: 30px;
        z-index: 500;
        height: 50px;
        border-radius: 25px;
        overflow: hidden;
        background: #444;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;

        & > * {
        float: left;
        }
        }

        #menu-toggle {
        display: block;
        cursor: pointer;
        opacity: 0;
        z-index: 999;
        margin: 0;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 0;
        left: 0;

        &:checked ~ ul {
        width: 150px;
        background-position: 0px -50px;
        }
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 0 0 0 50px;
        height: 50px;
        width: 0px;
        transition: 0.5s width ease;
        background-image: url("https://i.imgur.com/3d0vJzn.png");
        background-repeat: no-repeat;
        background-position: 0px 0px;
        }

        li {
        display: inline-block;
        line-height: 50px;
        width: 50px;
        text-align: center;
        margin: 0;

        a {
        font-size: 1.25em;
        font-weight: bold;
        color: white;
        text-decoration: none;
        }
        }



    </nav> --}}

    {{-- <div id="menu">
        <input type="checkbox" id="menu-toggle" />
        <ul>
            <li>
                <a href="#">&#x2708;</a>
            </li>
            <li>
                <a href="#">&#x266b;</a>
            </li>
            <li>
                <a href="#">&#x2709;</a>
            </li>
        </ul>

        html, body{
        margin:0;
        padding:0;
        font-family:sans-serif;
        }

        #menu{
        position:absolute;
        top:30px;
        left:30px;
        z-index:500;
        height:50px;
        border-radius:25px;
        overflow:hidden;
        background:#444;
        box-shadow:0px 0px 10px rgba(0,0,0,.5);
        transition:all .5s ease;

        &>*{
        float:left;
        }
        }

        #menu-toggle{
        display:block;
        cursor:pointer;
        opacity:0;
        z-index:999;
        margin:0;
        width:50px;
        height:50px;
        position:absolute;
        top:0;
        left:0;

        &:checked~ul{
        width:150px;
        background-position:0px -50px;
        }
        }

        ul{
        list-style-type:none;
        margin:0;
        padding:0 0 0 50px;
        height:50px;
        width:0px;
        transition:.5s width ease;
        background-image:url("https://i.imgur.com/3d0vJzn.png");
        background-repeat:no-repeat;
        background-position:0px 0px;
        }

        li{
        display:inline-block;
        line-height:50px;
        width:50px;
        text-align:center;
        margin:0;

        a{
        font-size:1.25em;
        font-weight:bold;
        color:white;
        text-decoration:none;
        }
        }
    </div> --}}
</body>

</html>
