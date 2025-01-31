<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PBBrasserie Menu Page</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />
    <link href="frontend/3/css/templatemo-style.css" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="frontend/2/images/test.jpg" />
</head>


<body>

    <div class="container">
        <!-- Top box -->
        <!-- Logo & Site Name -->
        <div class="placeholder">
            <div class="parallax-window" data-parallax="scroll" data-image-src="/frontend/3/img/simple-house-01.jpg">
                <div class="tm-header">
                    <div class="row tm-header-inner">
                        <div class="col-md-6 col-12">
                            {{-- <img src="frontend/3/img/simple-house-logo.png" alt="Logo" class="tm-site-logo" /> --}}
                            <a href="/" class=""> <img style="height: auto; width: 90px;"
                                    src="frontend/2/images/test.png" alt="Steak House" class="tm-site-logo" /></a>

                            <div class="tm-site-text-box">
                                <h1 class="tm-site-title">Pbbrasserie</h1>
                                <h6 class="tm-site-description">Our menu</h6>

                            </div>
                        </div>
                        <nav class="col-md-6 col-12 tm-nav">
                            <ul class="tm-nav-ul">
                                {{-- <li class="tm-nav-li"><a href="/" class="tm-nav-link active">Home</a></li> --}}
                                {{-- <li class="tm-nav-li"><a href="about.html" class="tm-nav-link">About</a></li>
                                <li class="tm-nav-li"><a href="contact.html" class="tm-nav-link">Contact</a></li> --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <header class="row tm-welcome-section">
                <h2 class="col-12 text-center tm-section-title">Welcome to PBBrasserie Steak house</h2>
                <p class="col-12 text-center">Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus
                    accumsanNam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan.</p>
            </header>

            <div class="tm-paging-links">
                <nav>
                    <ul>
                        <li class="tm-paging-item"><a href="#" class="tm-paging-link active">Breakfast</a></li>
                        <li class="tm-paging-item"><a href="#" class="tm-paging-link">Lunch</a></li>
                        <li class="tm-paging-item"><a href="#" class="tm-paging-link">Dinner</a></li>
                        <li class="tm-paging-item"><a href="#" class="tm-paging-link">Brunch</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Gallery -->
            <div class="row tm-gallery">
                <!-- gallery page 1 -->
                <div id="tm-gallery-page-breakfast" class="tm-gallery-page">
                    {{-- <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/01.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Fusce dictum finibus</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$45 / $55</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/02.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Aliquam sagittis</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$65 / $70</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/03.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Sed varius turpis</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$30.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/04.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Aliquam sagittis</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$25.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/05.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Maecenas eget justo</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$80.25</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/06.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Quisque et felis eros</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$20 / $40 / $60</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/07.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Sed ultricies dui</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$94</p>
                            </figcaption>
                        </figure>
                    </article>

                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/08.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Donec porta consequat</h4>
                                <p class="tm-gallery-description">Nam in suscipit nisi, sit amet consectetur metus. Ut
                                    sit amet tellus accumsan</p>
                                <p class="tm-gallery-price">$15</p>
                            </figcaption>
                        </figure>
                    </article> --}}
                    @unless (count($breakfasts) == 0)
                        @foreach ($breakfasts as $food)
                            <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                                <figure>
                                    <img src="{{ asset('uploads/' . $food->image) }}" alt="{{ $food->name }}"
                                        class="img-fluid tm-gallery-img" />
                                    <figcaption>
                                        <h4 class="tm-gallery-title">{{ $food->en_name }}</h4>
                                        <p class="tm-gallery-description">{{ $food->en_description }}</p>
                                        <p class="tm-gallery-price">${{ $food->price }}</p>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="">No listings found</p>
                    @endunless

                </div> <!-- gallery page 1 -->

                <!-- gallery page 2 -->
                <div id="tm-gallery-page-lunch" class="tm-gallery-page hidden">
                    {{-- <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/04.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Salad Menu One</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$25</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/03.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Second Title Salad</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$30</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/05.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Third Salad Item</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$45</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/01.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Superior Salad</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/08.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Sed ultricies dui</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$55 / $60</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/07.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Maecenas eget justo</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$75</p>
                            </figcaption>
                        </figure>
                    </article> --}}
                    @unless (count($lunchs) == 0)
                        @foreach ($lunchs as $food)
                            <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                                <figure>
                                    <img src="{{ asset('uploads/' . $food->image) }}" alt="{{ $food->name }}"
                                        class="img-fluid tm-gallery-img" />
                                    <figcaption>
                                        <h4 class="tm-gallery-title">{{ $food->en_name }}</h4>
                                        <p class="tm-gallery-description">{{ $food->en_description }}</p>
                                        <p class="tm-gallery-price">${{ $food->price }}</p>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="">No listings found</p>
                    @endunless
                </div> <!-- gallery page 2 -->

                <!-- gallery page 3 -->
                <div id="tm-gallery-page-dinner" class="tm-gallery-page hidden">
                    {{-- <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/08.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Noodle One</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$12.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/07.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Noodle Second</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$15.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/06.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Third Soft Noodle</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$20.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/05.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Aliquam sagittis</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$30.25</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/04.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Maecenas eget justo</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$35.50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/03.jpg" alt="Image"
                                class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Quisque et felis eros</h4>
                                <p class="tm-gallery-description">Orci varius natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus.</p>
                                <p class="tm-gallery-price">$40.50</p>
                            </figcaption>
                        </figure>
                    </article> --}}
                    @unless (count($dinners) == 0)
                        @foreach ($dinners as $food)
                            <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                                <figure>
                                    <img src="{{ asset('uploads/' . $food->image) }}" alt="{{ $food->name }}"
                                        class="img-fluid tm-gallery-img" />
                                    <figcaption>
                                        <h4 class="tm-gallery-title">{{ $food->en_name }}</h4>
                                        <p class="tm-gallery-description">{{ $food->en_description }}</p>
                                        <p class="tm-gallery-price">${{ $food->price }}</p>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="">No listings found</p>
                    @endunless

                </div> <!-- gallery page 3 -->

                <!-- gallery page 2 -->
                <div id="tm-gallery-page-brunch" class="tm-gallery-page hidden">
                    {{-- <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/04.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Salad Menu One</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$25</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/03.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Second Title Salad</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$30</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/05.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Third Salad Item</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$45</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/01.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Superior Salad</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$50</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/08.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Sed ultricies dui</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$55 / $60</p>
                            </figcaption>
                        </figure>
                    </article>
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <figure>
                            <img src="frontend/3/img/gallery/07.jpg" alt="Image" class="img-fluid tm-gallery-img" />
                            <figcaption>
                                <h4 class="tm-gallery-title">Maecenas eget justo</h4>
                                <p class="tm-gallery-description">Proin eu velit egestas, viverra sapien eget,
                                    consequat nunc. Vestibulum tristique</p>
                                <p class="tm-gallery-price">$75</p>
                            </figcaption>
                        </figure>
                    </article> --}}
                    @unless (count($brunchs) == 0)
                        @foreach ($brunchs as $food)
                            <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                                <figure>
                                    <img src="{{ asset('uploads/' . $food->image) }}" alt="{{ $food->name }}"
                                        class="img-fluid tm-gallery-img" />
                                    <figcaption>
                                        <h4 class="tm-gallery-title">{{ $food->en_name }}</h4>
                                        <p class="tm-gallery-description">{{ $food->en_description }}</p>
                                        <p class="tm-gallery-price">${{ $food->price }}</p>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    @else
                        <p class="">No listings found</p>
                    @endunless
                </div> <!-- gallery page 2 -->
            </div>
            <div class="tm-section tm-container-inner">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="tm-description-figure">
                            <img src="frontend/3/img/img-01.jpg" alt="Image" class="img-fluid" />
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="tm-description-box">
                            <h4 class="tm-gallery-title">Maecenas nulla neque</h4>
                            <p class="tm-mb-45">Redistributing this template as a downloadable ZIP file on any template
                                collection site is strictly prohibited. You will need to <a rel="nofollow"
                                    href="#">talk to us</a> for additional permissions
                                about our templates. Thank you.</p>
                            <a href="#" class="tm-btn tm-btn-default tm-right">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>



        <footer class="tm-footer text-center">
            <p>Copyright &copy; <?php echo date('Y'); ?> Pbbrasserie

                | Design: <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
        </footer>
    </div>


    <script src="frontend/3/js/jquery.min.js"></script>
    <script src="frontend/3/js/parallax.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle click on paging links
            $('.tm-paging-link').click(function(e) {
                e.preventDefault();

                var page = $(this).text().toLowerCase();
                $('.tm-gallery-page').addClass('hidden');
                $('#tm-gallery-page-' + page).removeClass('hidden');
                $('.tm-paging-link').removeClass('active');
                $(this).addClass("active");
            });
        });
    </script>
</body>

</html>
