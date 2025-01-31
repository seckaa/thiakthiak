<?php

namespace App\Providers;

use App\Models\Shop;
use App\Observers\ShopObserver;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //will leyt voyager to use customm model instead
        Voyager::useModel('Category', \App\Models\Category::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Shop::observe(ShopObserver::class);

        // if(Schema::hasTable('categories')) {

        //     $categories = cache()->remember('categories','3600', function(){
        //         return Category::whereNull('parent_id')->get();
        //     });

        //     view()->share('categories', $categories);
        // }
    }
}
