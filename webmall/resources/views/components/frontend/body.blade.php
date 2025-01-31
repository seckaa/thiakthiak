<!-- HOME -->
<section id="home" class="slider" data-stellar-background-ratio="0.5">
    <div class="row">

        <div class="owl-carousel owl-theme">
            {{-- <div class="item item-first"> --}}
            <div class="item item-first" style="background-image: url(/frontend/images/slider-image1.jpg);">
                <div class="caption">
                    <div class="container">
                        <div class="col-md-8 col-sm-12">
                            <h3>Eatery Cafe &amp; Restaurant</h3>
                            <h1>Our mission is to provide an unforgettable experience</h1>
                            <a href="#team" class="section-btn btn btn-default smoothScroll">Meet our chef</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="item item-second"> --}}
            <div class="item item-second" style="background-image: url(/frontend/images/slider-image2.jpg);">
                <div class="caption">
                    <div class="container">
                        <div class="col-md-8 col-sm-12">
                            <h3>Your Perfect Breakfast</h3>
                            <h1>The best dinning quality can be here too!</h1>
                            <a href="#menu" class="section-btn btn btn-default smoothScroll">Weekly Picks</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="item item-third"> --}}
            <div class="item item-third" style="background-image: url(/frontend/images/slider-image3.jpg);">
                <div class="caption">
                    <div class="container">
                        <div class="col-md-8 col-sm-12">
                            <h3>New Restaurant in Town</h3>
                            <h1>Enjoy our special menus every Sunday and Friday</h1>
                            <a href="{{ route('books.index') }}"
                                class="section-btn btn btn-default smoothScroll">Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Quick pick MENU-->
<section id="menu" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Our Weekly Picks</h2>
                    <h4>Breakfast, Lunch &amp; Dining</h4>
                </div>
            </div>

            @unless (count($foods) == 0)
                @foreach ($foods as $food)
                    <div class="col-md-4 col-sm-6">
                        <!-- MENU THUMB -->
                        <div class="menu-thumb">
                            <a href="{{ asset('storage/' . $food->cover_img) }}" class="" title="{{ $food->name }}">
                                @php
                                    $name = Str::of($food->name)->substrReplace('...', 18);
                                    $description = Str::of($food->description)->substrReplace('...', 25);

                                    $img = str_replace('\\', '/', $food->cover_img);

                                @endphp
                                <img src="{{ $food->cover_img ? asset('storage/' . $img) : asset('/no-image.png') }}"
                                    alt="{{ $food->name }}" />
                                <div class="menu-info">
                                    <div class="menu-item">
                                        <h3>
                                            {{ $name }}
                                        </h3>
                                        <p>{{ $description }}</p>
                                    </div>
                                    <div class="menu-price">
                                        <a href="/menu" class=""><span>${{ $food->price }}</span></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="">No listings found</p>
            @endunless

        </div>
    </div>
</section>

<!-- video -->
<section data-stellar-background-ratio="0 .5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                {{-- <h1>test</h1> --}}
                <video autoplay loop muted controls style="width: 100%">
                    <source src="/frontend/images/video.mp4" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="about-info">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                        <h4>Read our story</h4>
                        <h2>We've been Making The Delicious Foods Since 2008</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.4s">
                        <p>Fusce hendrerit malesuada lacinia. Donec semper semper sem vitae malesuada. Proin
                            scelerisque risus et ipsum semper molestie sed in nisi. Ut rhoncus congue lectus, rhoncus
                            venenatis leo malesuada id.</p>
                        <p>Sed elementum vel felis sed scelerisque. In arcu diam, sollicitudin eu nibh ac, posuere
                            tristique magna. You can use this template for your cafe or restaurant website. Please
                            tell your friends about <a href="https://plus.google.com/+templatemo"
                                target="_parent">templatemo</a>. Thank you.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="wow fadeInUp about-image" data-wow-delay="0.6s">
                    <img src="frontend/images/about-image.jpg" class="img-responsive" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TEAM -->
<section id="team" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Meet our chefs</h2>
                    <h4>They are nice &amp; friendly</h4>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                    <img src="frontend/images/team-image1.jpg" class="img-responsive" alt="">
                    <div class="team-hover">
                        <div class="team-item">
                            <h4>Duis vel lacus id magna mattis vehicula</h4>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                <li><a href="#" class="fa fa-envelope-o"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>New Catherine</h3>
                    <p>Kitchen Officer</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                    <img src="frontend/images/team-image2.jpg" class="img-responsive" alt="">
                    <div class="team-hover">
                        <div class="team-item">
                            <h4>Cras suscipit neque quis odio feugiat</h4>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-instagram"></a></li>
                                <li><a href="#" class="fa fa-flickr"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Lindsay Perlen</h3>
                    <p>Owner &amp; Manager</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                    <img src="frontend/images/team-image3.jpg" class="img-responsive" alt="">
                    <div class="team-hover">
                        <div class="team-item">
                            <h4>Etiam auctor enim tristique faucibus</h4>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-github"></a></li>
                                <li><a href="#" class="fa fa-google"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Isabella Grace</h3>
                    <p>Pizza Specialist</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TESTIMONIAL -->
<section id="testimonial" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Testimonials</h2>
                </div>
            </div>

            <div class="col-md-offset-2 col-md-8 col-sm-12">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus
                            mollis interdum ullamcorper nulla non.</p>
                        <div class="tst-author">
                            <h4>Digital Carlson</h4>
                            <span>Pharetra quam sit amet</span>
                        </div>
                    </div>

                    <div class="item">
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas. Sed vestibulum orci quam.</p>
                        <div class="tst-author">
                            <h4>Johnny Stephen</h4>
                            <span>Magna nisi porta ligula</span>
                        </div>
                    </div>

                    <div class="item">
                        <p>Vivamus aliquet felis eu diam ultricies congue. Morbi porta lorem nec consectetur porta
                            quis dui elit habitant morbi.</p>
                        <div class="tst-author">
                            <h4>Jessie White</h4>
                            <span>Vitae lacinia augue urna quis</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <!-- How to change your own map point
      1. Go to Google Maps
      2. Click on your location point
      3. Click "Share" and choose "Embed map" tab
      4. Copy only URL and paste it within the src="" field below
            -->
            <div class="wow fadeInUp col-md-6 col-sm-12" data-wow-delay="0.4s">
                <div id="google-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3019.4716098834538!2d-73.94415582396901!3d40.81760367137798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f6774c4f8235%3A0x4e9c19c275383386!2sPonty%20Bistro!5e0!3m2!1sen!2sus!4v1701224422187!5m2!1sen!2sus"
                        allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Contact Us</h2>
                    </div>
                </div>

                <!-- CONTACT FORM -->
                <form action="{{ route('send.email') }}" method="GET" class="wow fadeInUp" id="contact-form"
                    role="form" data-wow-delay="0.8s">
                    @csrf

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!-- IF MAIL SENT SUCCESSFUL  // connect this with custom JS -->
                    {{-- <h6 class="text-success">Your message has been sent successfully.</h6> --}}

                    <!-- IF MAIL NOT SENT -->
                    {{-- <h6 class="text-danger">E-mail must be valid and message must be longer than 1 character.</h6> --}}

                    <div class="col-md-12 col-sm-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="cf-name"
                            name="name" value="{{ old('name') }}" placeholder="Full name">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="col-md-6 col-sm-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="cf-email" name="email" value="{{ old('email') }}" placeholder="Email address">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" class="form-control @error('number') is-invalid @enderror"
                            id="cf-phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                id="cf-subject" name="subject" value="{{ old('subject') }}" placeholder="Subject">
                            @error('subject')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="">
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="6" id="cf-message" name="message"
                                value="{{ old('message') }}" placeholder="Tell us about your project"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="form-control" id="cf-submit" name="submit">Send
                            Message</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var errors = $('.is-invalid')
            if (errors.length) {
                $(document).scrollTop(errors.offset().top)
            }
        });
    </script>
</section>

{{-- pop up --}}
<div class="hide">
    <style>
        .popScroll {
            font-family: 'Open Sans Condensed', sans-serif;
        }

        /* CSS Code */
        .popScroll {
            position: fixed;
            z-index: 10000000;
            top: 0;
            display: table;
            text-align: center;
            width: 100%;
            height: 100%;

        }


        .popup {
            z-index: 10;
            width: 450px;
            height: 480px;
            position: relative;
            margin: 20px auto;
            display: block;
            text-align: center;
            -moz-background-clip: padding;
            -o-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            /* prevents bg color from leaking outside the border */
            background-color: #fff;
            /* layer fill content */
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            -webkit-transform-origin: top center;
            -moz-transform-origin: top center;
            -o-transform-origin: top center;
            transform-origin: top center;
            -webkit-animation: iconosani 1.2s forwards;
            animation: iconosani 1.2s forwards;
            -moz-animation: iconosani 1.2s forwards;
            -o-animation: iconosani 1.2s forwards;
        }

        @-webkit-keyframes iconosani {
            0% {
                -webkit-transform: perspective(800px) rotateX(-90deg);
                -moz-transform: perspective(800px) rotateX(-90deg);
                -o-transform: perspective(800px) rotateX(-90deg);
                opacity: 1;
            }

            40% {
                -webkit-transform: perspective(800px) rotateX(30deg);
                -moz-transform: perspective(800px) rotateX(30deg);
                -o-transform: perspective(800px) rotateX(30deg);
                opacity: 1;
            }

            70% {
                -webkit-transform: perspective(800px) rotateX(-10deg);
                -moz-transform: perspective(800px) rotateX(-10deg);
                -o-transform: perspective(800px) rotateX(-10deg);
            }

            100% {
                -webkit-transform: perspective(800px) rotateX(0deg);
                -moz-transform: perspective(800px) rotateX(0deg);
                -o-transform: perspective(800px) rotateX(0deg);
                opacity: 1;
            }
        }


        .popScroll h1 {
            height: 60px;
            position: relative;
            color: #fff;
            font: 25px/60px sans-serif;
            text-align: center;
            text-transform: uppercase;
            background: #3D79D0;
        }

        .popScroll form {
            margin: 10px auto;
        }

        .subscribe-widget .email-form {
            font-size: 13px;
            color: #999999;
            padding-left: 6px;
            width: 270px;
            border: 1px solid #e0e0e0;
            padding: 5px 0 5px 5px;
            line-height: 25px;
        }

        .subscribe-widget .button {
            background: #3D79D0;
            padding: 6px 15px;
            color: #fff;
            border: none;
            line-height: 25px;
            margin-left: 0;
            cursor: pointer;
        }

        .popScroll input[type="submit"] {
            -webkit-appearance: button;
            -moz-appearance: button;
            -o-appearance: button;
            cursor: pointer;
        }

        .popScroll p {
            padding: 1px 5px;
            font-family: 'Open Sans';
            font-size: 17px;
            margin-bottom: 10px;
        }


        #option {
            position: relative;
        }

        .boxi {
            display: inline-block;
            width: 169px;
            line-height: 42px;
            color: #fff;
            text-align: center;
            text-decoration: none;
            -webkit-transition: all 0.1s linear;
            -moz-transition: all 0.1s linear;
            -o-transition: all 0.1s linear;
        }

        #home {
            background: #3D79D0;
        }

        #close {
            background: #D21111;
        }

        .popScroll em {
            width: 42px;
            display: inline-block;
            position: relative;
            margin: 0 -20px;
            line-height: 42px;
            background: #fff;
            color: #777;
            text-align: center;
            border-radius: 50px;
        }

        #home:hover {
            background: #1852C7;
        }

        #close:hover {
            background: #B30E0E;
        }


        .popScroll.overlay:after {
            content: '';
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            z-index: 0;
            opacity: .8;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: #000;
        }

        /* Prevents scrolling */
        .popScroll.overlay {
            overflow: hidden;
            max-height: 100%;
            max-width: 100%;
        }


        .ribbon {
            position: absolute;
            z-index: 100;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }

        .ribbon.top-left {
            top: -2.6px;
            left: -5px;
        }

        .ribbon.top-left.ribbon-primary>small {
            *zoom: 1;
            filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FF428BCA', endColorstr='#FF2A6496');
            background-image: -moz-linear-gradient(top, #428bca 0%, #2a6496 100%);
            background-image: -webkit-linear-gradient(top, #428bca 0%, #2a6496 100%);
            background-image: linear-gradient(to bottom, #428bca 0%, #2a6496 100%);
            position: absolute;
            display: block;
            width: 100%;
            padding: 8px 10px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 65%;
            color: white;
            background-color: #428bca;
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -moz-box-shadow: 0 3px 6px -3px rgba(0, 0, 0, 0.5);
            -webkit-box-shadow: 0 3px 6px -3px rgba(0, 0, 0, 0.5);
            box-shadow: 0 3px 6px -3px rgba(0, 0, 0, 0.5);
            top: 16px;
            left: -27px;
        }

        .ribbon.top-left.ribbon-primary>small:before,
        .ribbon.top-left.ribbon-primary>small:after {
            position: absolute;
            content: " ";
        }

        .ribbon.top-left.ribbon-primary>small:before {
            left: 0;
        }

        .ribbon.top-left.ribbon-primary>small:after {
            right: 0;
        }

        .ribbon.top-left.ribbon-primary>small:before,
        .ribbon.top-left.ribbon-primary>small:after {
            bottom: -3px;
            border-top: 3px solid #0e2132;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
        }

        .banner {
            width: 300px;
            height: 250px;
            position: relative;
            margin: 10px auto;
            display: block;
            text-align: center;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            /* prevents bg color from leaking outside the border */
            background-color: #fff;
            /* layer fill content */
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
            box-shadow: 0 0 10px rgba(0, 0, 0, .18);
            /* drop shadow */
        }

        .adstext {
            margin-top: 20px;
            color: #000;
            position: relative;
        }


        @media screen and (max-width: 600px) {


            .popup {
                width: 370px;
                height: 480px;
            }


            .popScroll h1 {
                height: 40px;
                font: 18px/40px sans-serif;
            }

            .subscribe-widget .email-form {
                width: 210px;
            }

            .adstext {
                margin-top: 20px;
            }

        }

        @media screen and (max-width: 400px) {


            .popup {
                width: 350px;
                height: 480px;
            }


            .popScroll h1 {
                height: 40px;
                font: 18px/40px sans-serif;
            }

            .subscribe-widget .email-form {
                width: 210px;
            }


            .banner {
                margin: 10px auto;

            }

            .adstext {
                margin-top: 20px;
            }
        }

        input.email-form:active,
        input.email-form:focus {
            -webkit-animation: fade 0.55s ease-in;
            -moz-animation: fade 0.55s ease-in;
            animation: fade 0.55s ease-in;
        }

        @-webkit-keyframes fade {
            0% {
                box-shadow: 0 0 0 0 transparent;
            }

            66% {
                box-shadow: 0 0 0 10px #3D79D0, 0 0 0 12px white;
            }

            100% {
                box-shadow: 0 0 0 20px transparent, 0 0 0 22px transparent;
            }
        }

        @-moz-keyframes fade {
            0% {
                box-shadow: 0 0 0 0 transparent;
            }

            66% {
                box-shadow: 0 0 0 10px #3D79D0, 0 0 0 12px white;
            }

            100% {
                box-shadow: 0 0 0 20px transparent, 0 0 0 22px transparent;
            }
        }

        @-o-keyframes fade {
            0% {
                box-shadow: 0 0 0 0 transparent;
            }

            66% {
                box-shadow: 0 0 0 10px #3D79D0, 0 0 0 12px white;
            }

            100% {
                box-shadow: 0 0 0 20px transparent, 0 0 0 22px transparent;
            }
        }

        @keyframes fade {
            0% {
                box-shadow: 0 0 0 0 transparent;
            }

            66% {
                box-shadow: 0 0 0 10px #3D79D0, 0 0 0 12px white;
            }

            100% {
                box-shadow: 0 0 0 20px transparent, 0 0 0 22px transparent;
            }
        }
    </style>
    <style>
        .blur-in {
            -webkit-animation: blur 2s forwards;
            -moz-animation: blur 2s forwards;
            -o-animation: blur 2s forwards;
            animation: blur 2s forwards;
        }

        .blur-out {
            -webkit-animation: blur-out 2s forwards;
            -moz-animation: blur-out 2s forwards;
            -o-animation: blur-out 2s forwards;
            animation: blur-out 2s forwards;
        }

        @-webkit-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-moz-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-o-keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @keyframes blur {
            0% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }

            100% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }
        }

        @-webkit-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @-moz-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @-o-keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @keyframes blur-out {
            0% {
                -webkit-filter: blur(4px);
                -moz-filter: blur(4px);
                -o-filter: blur(4px);
                -ms-filter: blur(4px);
                filter: blur(4px);
            }

            100% {
                -webkit-filter: blur(0px);
                -moz-filter: blur(0px);
                -o-filter: blur(0px);
                -ms-filter: blur(0px);
                filter: blur(0px);
            }
        }
    </style>

    <!-- popup -->
    <div class="popScroll">
        <div class="popup">
            <span class="ribbon top-left ribbon-primary">
                <small>Hello!</small>
            </span>
            <h1>Join Funda Clear Now</h1>
            <div class="subscribe-widget">
                <!-- form -->
                <form id="subscribe-form">
                    <input type="email" name="email" placeholder="Your Email Please" class="email-form"
                        required>
                    <button type="submit" class="button">Subscribe</button>
                </form>
                <!-- end form-->
            </div>
            <p>Close the Pop up or You can Go Home Now.</p>
            <div id="option">
                <a href="#" id="home" class="boxi">Home</a>
                <em>or</em>
                <a href="#" id="close" class="boxi closei">Close</a>
                <p class="adstext"><u>Our admosphere</u></p>
                {{-- <div class='video-wrapper'>
                    <div class='video'>
                        <iframe id="player" width="290" height="200"
                            src="https://www.youtube.com/embed/GAamW074WdM" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div> --}}
                <div class="col-md-12 col-sm-12 video-wrapper">
                    {{-- <h1>test</h1> --}}
                    <video autoplay loop muted controls style="width: 100%">
                        <source src="/frontend/images/video.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>

            </div>
        </div>
    </div>

    {{-- <script>
        var $box = $('.box');

        $('.closei').each(function() {

            // $('body').toggleClass('overlay');
            $("#pop-toggle").click(function() {
                $(".popup").toggle();
                // $('body').toggleClass('overlay');
            })
            $(".close").click(function() {
                $(".popup").toggle();
                // $('body').toggleClass('overlay');
            });

        });
    </script> --}}

    <script>
        // $(document).ready(function() {

        $(function() {
            $('.popScroll').hide();
            $('.popScroll').fadeIn(1000);

            $(".close").click(function(e) {
                $(".popup").toggle();
                $('.popScroll').fadeOut(1000);
                // $('body').removeClass('blur-in');
                // $('body').addClass('blur-out');
                e.stopPropagation();
            });
        });
        // })
    </script>
</div>
