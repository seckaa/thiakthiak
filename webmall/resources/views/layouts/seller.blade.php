<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PBBrasserie') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="/../../pbbblack.svg">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    {{-- <!--notifications for 1st -->
    <script src="{{ asset('js/sound-notification.js') }}"></script>
    <!--notifications for 2nd -->
    <script src="{{ route('voyager_sound_notification') }}"></script> --}}
</head>

<body>
    <div id="app">


        <main class="py-4 container-fluid">
            <div class="row">
                <div class="col-sm-6 col-md-3">

                    <div class="list-group">
                        <a href="/seller" class="list-group-item list-group-item-action active">Dashboard</a>
                        <a href=" {{ route('seller.orders.index') }} "
                            class="list-group-item list-group-item-action">Orders</a>
                        <a href=" {{ url('/admin/shops') }} " class="list-group-item list-group-item-action">Go to
                            Shop</a>
                    </div>

                </div>

                <div class="col-sm- col-9">
                    @yield('content')
                </div>

            </div>
        </main>
    </div>
    <div><audio id="order_notification" src="/sounds/notification.mp3"></audio>
    </div>

    <!-- Minified version -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Uncompressed version (for development, includes comments and formatting) -->
    <script src="https://code.jquery.com/jquery.js"></script>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                getNewToOrder();
            }, 10 * 1000);
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     setInterval(function() {
        //         getNewToOrder();
        //     }, 10 * 1000);
        // });

        function getNewToOrder() {
            // console.log("getting data");
            $.ajax({
                url: "/api/get_new_order",
                type: 'get',
                data: {
                    lastid: 1
                },
                success: function(response) {
                    //  console.log(response.code);
                    if (response.code == 0) {
                        // console.log("new order" + response.data);
                        // update
                        // toastr.success('new order!');
                        let music = $("#order_notification")[0];
                        if (music.paused) {
                            music.play();
                        } else {
                            music.pause();
                        }
                        setTimeout(function() {
                            window.location.href = "/seller/orders/" + response.data;
                        }, "5000");
                    } else if (response.code == -1) {}
                },
                error: function(err) {
                    console.log("err---》" + err);
                },
            });


        }
    </script>


</body>


</html>
