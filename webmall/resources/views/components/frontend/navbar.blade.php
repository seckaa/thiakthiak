<!-- PRE LOADER -->
<section class="preloader">
    <div class="spinner">

        <span class="spinner-rotate"></span>

    </div>
</section>


<!-- MENU -->
<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <!-- lOGO TEXT HERE -->
            <a href="#home" class="navbar-brand">
                <div class="col ">
                    {{-- <div class="row hidden-xs menu-thumb"><img
                            style="height: auto; width: 80px;"src="frontend/2/images/test.png" alt=""></div>
                    <div class="row hidden-lg hidden-md menu-thumb"><img
                            style="height: auto; width: 90px;"src="frontend/2/images/test.png" alt="">
                    </div> --}}
                    <div class="row hidden-xs menu-thumb"><img style="height: auto; width: 180px;"src="pontyB.svg"
                            alt="pbbrasserie"></div>
                    <div class="row hidden-lg hidden-md hidden-sm menu-thumb"><img
                            style="height: auto; width: 200px;"src="pontyB.svg" alt="pbbrasserie">
                    </div>
                    {{-- <div class="row hidden-lg hidden-md">P<span>.</span>B<span>.</span>Brasserie<span>.</span> Steak
                        house</div> --}}

                </div>
            </a>
        </div>

        <!-- MENU LINKS -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-nav-first">
                <li><a href="#home" class="smoothScroll">Home</a></li>
                <li><a href="/shopping" class="smoothScroll">Order</a></li>
                <li><a href="#team" class="smoothScroll">Chef</a></li>
                <li><a href="#menu" class="smoothScroll">Picks</a></li>
                <li><a href="#about" class="smoothScroll">About</a></li>
                <li><a href="#contact" class="smoothScroll">Email</a></li>
                {{-- @auth
                    <li><a href="" onclick="requestPermission()"class="smoothScroll">keep^</a></li>
                @endauth --}}
                {{-- @if (Auth::guest())
                    <li><a href="/user/login" class="smoothScroll">login</a></li>
                @else
                    <li><a href="/user/logout" class="smoothScroll">logout</a></li>
                @endif --}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Call Now! <i class="fa fa-phone"></i> 010 020 0340</a></li>
                <a href="{{ route('books.index') }}" class="section-btn">Reserve a table</a>
            </ul>
        </div>

    </div>
</section>
