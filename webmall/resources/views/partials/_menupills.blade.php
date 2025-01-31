<section>
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <!--Tabs navigation-->
    <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0" role="tablist" data-te-nav-ref>
        <li role="presentation">
            <a href="#tabs-home"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill" data-te-target="#tabs-home" data-te-nav-active role="tab"
                aria-controls="tabs-home" aria-selected="true">Breakfast</a>
        </li>
        <li role="presentation">
            <a href="#tabs-profile"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill" data-te-target="#tabs-profile" role="tab" aria-controls="tabs-profile"
                aria-selected="false">Lunch</a>
        </li>
        <li role="presentation">
            <a href="#tabs-messages"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill" data-te-target="#tabs-messages" role="tab" aria-controls="tabs-messages"
                aria-selected="false">Dinner</a>
        </li>
        <li role="presentation">
            <a href="#tabs-contact"
                class="disabled pointer-events-none my-2 block border-x-0 border-b-2 border-t-0 border-transparent bg-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-400 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent dark:text-neutral-600"
                data-te-toggle="pill" data-te-target="#tabs-contact" role="tab" aria-controls="tabs-contact"
                aria-selected="false">More</a>
        </li>
    </ul>

    <!--Tabs content-->
    <div class="mb-6">
        <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab" data-te-tab-active>
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
                @unless (count($breakfasts) == 0)
                    @foreach ($breakfasts as $food)
                        <x-main.listing-card :food="$food" />
                    @endforeach
                @else
                    <p>No listings found</p>
                @endunless

            </div>
            {{-- <div class="mt-6 p-4">
                {{ $breakfasts->links() }}
            </div> --}}
        </div>
        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
                @unless (count($lunchs) == 0)
                    @foreach ($lunchs as $food)
                        <x-main.listing-card :food="$food" />
                    @endforeach
                @else
                    <p>No listings found</p>
                @endunless

            </div>
        </div>
        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-messages" role="tabpanel" aria-labelledby="tabs-profile-tab">
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
                @unless (count($dinners) == 0)
                    @foreach ($dinners as $food)
                        <x-main.listing-card :food="$food" />
                    @endforeach
                @else
                    <p>No listings found</p>
                @endunless
            </div>
        </div>
        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">
            @unless (count($brunchs) == 0)
                @foreach ($brunchs as $food)
                    <x-main.listing-card :food="$food" />
                @endforeach
            @else
                <p>No listings found</p>
            @endunless
        </div>
    </div>
</section>
