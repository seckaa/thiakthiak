<section>

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <div id="carouselExampleCaptions" class="relative" data-te-carousel-init data-te-ride="carousel">
        <!--Carousel indicators-->
        <div class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
            data-te-carousel-indicators>
            <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="0" data-te-carousel-active
                class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="1"
                class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
                aria-label="Slide 2"></button>
            <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="2"
                class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
                aria-label="Slide 3"></button>
        </div>

        <!--Carousel items-->
        <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
            <!--First item-->
            <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                data-te-carousel-active data-te-carousel-item style="backface-visibility: hidden">
                <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(15).jpg" class="block w-full"
                    alt="..." />
                <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                    <h5 class="text-xl">First slide label</h5>
                    <p>
                        Some representative placeholder content for the first slide.
                    </p>
                </div>
            </div>
            <!--Second item-->
            <div class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                data-te-carousel-item style="backface-visibility: hidden">
                <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(22).jpg" class="block w-full"
                    alt="..." />
                <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                    <h5 class="text-xl">Second slide label</h5>
                    <p>
                        Some representative placeholder content for the second slide.
                    </p>
                </div>
            </div>
            <!--Third item-->
            <div class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                data-te-carousel-item style="backface-visibility: hidden">
                <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(23).jpg" class="block w-full"
                    alt="..." />
                <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                    <h5 class="text-xl">Third slide label</h5>
                    <p>
                        Some representative placeholder content for the third slide.
                    </p>
                </div>
            </div>
        </div>

        <!--Carousel controls - prev item-->
        <button
            class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
            type="button" data-te-target="#carouselExampleCaptions" data-te-slide="prev">
            <span class="inline-block h-8 w-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </span>
            <span
                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Previous</span>
        </button>
        <!--Carousel controls - next item-->
        <button
            class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
            type="button" data-te-target="#carouselExampleCaptions" data-te-slide="next">
            <span class="inline-block h-8 w-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </span>
            <span
                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Next</span>
        </button>
    </div>
    {{-- <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <div data-te-infinite-scroll-init class="max-h-[500px] overflow-y-scroll py-3 text-center"
        id="spinners-and-async-example">
        <div id="images">
            <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(100).webp" class="mb-3 h-auto w-full" />
            <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(105).webp" class="mb-3 h-auto w-full" />
            <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(106).webp" class="mb-3 h-auto w-full" />
        </div>
        <div id="spinner"
            class="hidden h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
            role="status">
            <span
                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
    </div> --}}

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->

</section>
<section class="mb-32">
    <div
        class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
        <div class="flex flex-wrap items-center">
            <div class="hidden shrink-0 grow-0 basis-auto lg:flex lg:w-6/12 xl:w-4/12">
                <img src="https://mdbcdn.b-cdn.net/img/new/ecommerce/vertical/088.jpg" alt="Trendy Pants and Shoes"
                    class="w-full rounded-t-lg lg:rounded-tr-none lg:rounded-bl-lg" />
            </div>
            <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 xl:w-8/12">
                <div class="px-6 py-12 md:px-12">
                    <h2 class="mb-4 text-2xl font-bold">
                        What's the secret of the great taste?
                    </h2>
                    <p class="mb-6 flex items-center font-bold uppercase text-danger dark:text-danger-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="mr-2 h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                        </svg>
                        Hot news
                    </p>
                    <p class="mb-6 text-neutral-500 dark:text-neutral-300">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Earum maxime voluptas ipsam aliquam itaque cupiditate
                        provident architecto expedita harum culpa odit, inventore rem
                        molestias laborum repudiandae corporis pariatur quo eius iste!
                        Quaerat, assumenda voluptates! Molestias, recusandae? Maxime
                        fuga omnis ducimus.
                    </p>
                    <p class="text-neutral-500 dark:text-neutral-300">
                        Commodi ut nisi assumenda alias maxime necessitatibus ad rem
                        repellat explicabo, reiciendis illum suscipit iusto? Provident
                        dignissimos similique, reiciendis inventore accusantium unde
                        mollitia, deleniti quae atque error id perspiciatis illum.
                        Laboriosam aperiam ab illo dignissimos obcaecati corporis
                        similique a odio, optio iste quis placeat alias amet rerum
                        sint quos dolor pariatur inventore possimus ad consequuntur
                        fugiat perferendis consectetur laudantium.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32">
        <h2 class="mb-16 text-center text-2xl font-bold">Latest articles</h2>

        <div class="mb-16 flex flex-wrap">
            <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                    data-te-ripple-init data-te-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/028.jpg" class="w-full"
                        alt="Louvre" />
                    <a href="#!">
                        <div
                            class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
                <h3 class="mb-4 text-2xl font-bold">That's the news!</h3>
                <div class="mb-4 flex items-center text-sm font-medium text-danger dark:text-danger-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-2 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                    </svg>
                    Travels
                </div>
                <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                    Published <u>14.01.2022</u> by
                    <a href="#!">Lisa McCartney</a>
                </p>
                <p class="mb-6 text-neutral-500 dark:text-neutral-300">
                    Ut pretium ultricies dignissim. Sed sit amet mi eget urna placerat
                    vulputate. Ut vulputate est non quam dignissim elementum. Donec a
                    ullamcorper diam.
                </p>
                <p class="text-neutral-500 dark:text-neutral-300">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quae
                    nulla saepe rerum aspernatur odio amet perferendis tempora
                    mollitia? Ratione unde magni omnis quaerat blanditiis cumque
                    dolore placeat rem dignissimos?
                </p>
            </div>
        </div>

        <div class="mb-16 flex flex-wrap lg:flex-row-reverse">
            <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
                <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                    data-te-ripple-init data-te-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/033.jpg" class="w-full"
                        alt="Louvre" />
                    <a href="#!">
                        <div
                            class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
                <h3 class="mb-4 text-2xl font-bold">Exhibition in Paris</h3>
                <div class="mb-4 flex items-center text-sm font-medium text-primary dark:text-primary-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-2 h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                    </svg>
                    Art
                </div>
                <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                    Published <u>12.01.2022</u> by
                    <a href="#!">Anna Doe</a>
                </p>
                <p class="text-neutral-500 dark:text-neutral-300">
                    Duis sagittis, turpis in ullamcorper venenatis, ligula nibh porta
                    dui, sit amet rutrum enim massa in ante. Curabitur in justo at
                    lorem laoreet ultricies. Nunc ligula felis, sagittis eget nisi
                    vitae, sodales vestibulum purus. Vestibulum nibh ipsum, rhoncus
                    vel sagittis nec, placerat vel justo. Duis faucibus sapien eget
                    tortor finibus, a eleifend lectus dictum. Cras tempor convallis
                    magna id rhoncus. Suspendisse potenti. Nam mattis faucibus
                    imperdiet. Proin tempor lorem at neque tempus aliquet. Phasellus
                    at ex volutpat, varius arcu id, aliquam lectus. Vestibulum mattis
                    felis quis ex pharetra luctus. Etiam luctus sagittis massa, sed
                    iaculis est vehicula ut.
                </p>
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                    data-te-ripple-init data-te-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/079.jpg" class="w-full"
                        alt="Louvre" />
                    <a href="#!">
                        <div
                            class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
                <h3 class="mb-4 text-2xl font-bold">Stock market boom</h3>
                <div class="mb-4 flex items-center text-sm font-medium text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-2 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                    Business
                </div>
                <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                    Published <u>10.01.2022</u> by
                    <a href="#!">Joe Svan</a>
                </p>
                <p class="text-neutral-500 dark:text-neutral-300">
                    Sed sollicitudin purus sed nulla dignissim ullamcorper. Aenean
                    tincidunt vulputate libero, nec imperdiet sapien pulvinar id.
                    Nullam scelerisque odio vel lacus faucibus, tincidunt feugiat
                    augue ornare. Proin ac dui vel lectus eleifend vestibulum et
                    lobortis risus. Nullam in commodo sapien. Curabitur ut erat congue
                    sem finibus eleifend egestas eu metus. Sed ut dolor id magna
                    rutrum ultrices ut eget libero. Duis vel porttitor odio. Ut
                    pulvinar sed turpis ornare tincidunt. Donec luctus, mi euismod
                    dignissim malesuada, lacus lorem commodo leo, tristique blandit
                    ante mi id metus. Integer et vehicula leo, vitae interdum lectus.
                    Praesent nulla purus, commodo at euismod nec, blandit ultrices
                    erat. Aliquam eros ipsum, interdum et mattis vitae, faucibus vitae
                    justo. Nulla condimentum hendrerit leo, in feugiat ipsum
                    condimentum ac. Maecenas sed blandit dolor.
                </p>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</div>
<!-- Container for demo purpose -->

<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
<div id="carouselExampleCaptions" class="relative" data-te-carousel-init data-te-ride="carousel">
    <div class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
        data-te-carousel-indicators>
        <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="0" data-te-carousel-active
            class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="1"
            class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
            aria-label="Slide 2"></button>
        <button type="button" data-te-target="#carouselExampleCaptions" data-te-slide-to="2"
            class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
            aria-label="Slide 3"></button>
    </div>
    <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
        <div class="relative float-left -mr-[100%] hidden w-full !transform-none opacity-0 transition-opacity duration-[600ms] ease-in-out motion-reduce:transition-none"
            data-te-carousel-fade data-te-carousel-item data-te-carousel-active>
            <video class="w-full" autoplay loop muted>
                <source src="https://tecdn.b-cdn.net/img/video/Tropical.mp4" type="video/mp4" />
            </video>
            <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                <h5 class="text-xl">First slide label</h5>
                <p>
                    Some representative placeholder content for the first slide.
                </p>
            </div>
        </div>
        <div class="relative float-left -mr-[100%] hidden w-full !transform-none opacity-0 transition-opacity duration-[600ms] ease-in-out motion-reduce:transition-none"
            data-te-carousel-fade data-te-carousel-item>
            <video class="w-full" autoplay loop muted>
                <source src="https://tecdn.b-cdn.net/img/video/forest.mp4" type="video/mp4" />
            </video>
            <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                <h5 class="text-xl">Second slide label</h5>
                <p>
                    Some representative placeholder content for the second slide.
                </p>
            </div>
        </div>
        <div class="relative float-left -mr-[100%] hidden w-full !transform-none opacity-0 transition-opacity duration-[600ms] ease-in-out motion-reduce:transition-none"
            data-te-carousel-fade data-te-carousel-item>
            <video class="w-full" autoplay loop muted>
                <source src="https://tecdn.b-cdn.net/img/video/Agua-natural.mp4" type="video/mp4" />
            </video>
            <div class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                <h5 class="text-xl">Third slide label</h5>
                <p>
                    Some representative placeholder content for the third slide.
                </p>
            </div>
        </div>
    </div>
    <button
        class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
        type="button" data-te-target="#carouselExampleCaptions" data-te-slide="prev">
        <span class="inline-block h-8 w-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </span>
        <span
            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Previous</span>
    </button>
    <button
        class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
        type="button" data-te-target="#carouselExampleCaptions" data-te-slide="next">
        <span class="inline-block h-8 w-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </span>
        <span
            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Next</span>
    </button>
</div>


<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full border text-center text-sm font-light dark:border-neutral-500">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                #
                            </th>
                            <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                First
                            </th>
                            <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                Last
                            </th>
                            <th scope="col" class="px-6 py-4">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                1
                            </td>
                            <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                Mark
                            </td>
                            <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                Otto
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">@mdo</td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                2
                            </td>
                            <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                Jacob
                            </td>
                            <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                Thornton
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">@fat</td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                3
                            </td>
                            <td colspan="2" class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                Larry the Bird
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
