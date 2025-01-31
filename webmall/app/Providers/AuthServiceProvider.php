<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\OrderManagement;
use App\Models\Shop;
use App\Policies\OrderManagementPolicy;
use App\Policies\ShopPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //uncomment if not using voyager
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // Shop::class => ShopPolicy::class,
        // OrderManagement::class => OrderManagementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();


        // Gate::define('seller', function($user){

        //     $role = $user->role->name ?? '';

        //     if ($role == 'seller') {
        //         return true;
        //     }

        //     return false;
        // });

        // Gate::define('customer', function($user){

        //     $role = $user->role->name ?? '';

        //     if ($role == 'user') {
        //         return true;
        //     }

        //     return false;
        // });

        // Gate::define('admin', function($user){

        //     $role = $user->role->name ?? '';

        //     if ($role == 'admin') {
        //         return true;
        //     }

        //     return false;
        // });
    }
}
