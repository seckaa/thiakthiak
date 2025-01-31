<!-- ======= Footer ======= -->
<!-- FOOTER -->
<footer id="footer" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-8">
                <div class="footer-info">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s">Find us</h2>
                    </div>
                    <address class="wow fadeInUp" data-wow-delay="0.4s">
                        <p>123 nulla a cursus rhoncus,<br> augue sem viverra 10870<br>id ultricies sapien</p>
                    </address>
                </div>
            </div>

            <div class="col-md-3 col-sm-8">
                <div class="footer-info">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s">Reservation</h2>
                    </div>
                    <address class="wow fadeInUp" data-wow-delay="0.4s">
                        <p>090-080-0650 | 090-070-0430</p>
                        <p><a href="mailto:info@company.com">info@company.com</a></p>
                        <p>LINE: eatery247 </p>
                        <p><a href="/books" style="color: #c79c60">Book online</a></p>
                    </address>
                </div>
            </div>

            <div class="col-md-4 col-sm-8">
                <div class="footer-info footer-open-hour">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s">Open Hours</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.4s">
                        <p>Monday: Closed</p>
                        <div>
                            <strong>Tuesday to Friday</strong>
                            <p>11:00 AM - 12:00 PM</p>
                        </div>
                        <div>
                            <strong>Saturday - Sunday</strong>
                            <p>9:00 AM - 10:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 text-center">
                <ul class="wow fadeInUp social-icon" data-wow-delay="0.4s">
                    <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                    <li><a href="#" class="fa fa-google"></a></li>
                    {{-- @auth
                        <li><a href="" onclick="requestPermission()"class="">keep up with us.</a></li>
                    @endauth --}}
                </ul>
                {{-- send to nav --}}
                {{-- @auth
                    <button onclick="requestPermission()">Enable Notification</button>
                @endauth --}}


                <div class="row pop-up">
                    <div class="box small-6 large-centered">
                        <a href="#" class="close-button">&#10006;</a>
                        <h3>lorem ipsum</h3>
                        <p>Integer non odio id ante rutrum dictum. Nam ac dapibus felis, at pharetra sapien. </p>
                        <p>Maecenas lacus nisi, pellentesque a congue vel, rhoncus sit amet lacus. Sed mattis ultrices
                            risus in tincidunt.</p>
                        <a href="#" class="button">Learn More</a>
                    </div>
                </div>

                <div class="wow fadeInUp copyright-text" data-wow-delay="0.8s">
                    <p><br>Copyright &copy; <?php echo date('Y'); ?> <br>Your Company Name

                        <br><br>Design: <a rel="nofollow" href="#" target="_parent">TemplateMo</a>
                    </p>
                </div>
            </div>

        </div>

    </div>
</footer>

<!-- SCRIPTS -->
<script src="frontend/js/jquery.js"></script>
<script src="frontend/js/bootstrap.min.js"></script>
<script src="frontend/js/jquery.stellar.min.js"></script>
<script src="frontend/js/wow.min.js"></script>
<script src="frontend/js/owl.carousel.min.js"></script>
<script src="frontend/js/jquery.magnific-popup.min.js"></script>
<script src="frontend/js/smoothscroll.js"></script>
<script src="frontend/js/custom.js"></script>


<script>
    // register service worker
    navigator.serviceWorker.register("sw.js");

    // request permission from browser
    function requestPermission() {
        Notification.requestPermission().then((permission) => {
            if (permission === 'granted') {

                // get service worker
                navigator.serviceWorker.ready.then((sw) => {

                    // subscribe
                    sw.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: "BBTwqFTkHLQDAiZjs7nsRRurjvDWjeMHA8voM4l_PACH8lPuXr_oEry6gV3uIsXyARKyyioDeFlVOeYyOkUS0NA"
                    }).then((subscription) => {

                        // subscription successful
                        fetch("/api/push-subscribe{{ auth()->user()->id ?? 1 }}", {
                            // fetch("/api/push-subscribe{{ auth()->user()->id ?? null }}", {
                            method: "post",
                            body: JSON.stringify(subscription),
                        }).then(alert(
                            "Notification registered successfull, thank you"
                        )).catch(function(err) {
                            console.log(err);
                        });
                    });
                });
            }
        });
    }
</script>
