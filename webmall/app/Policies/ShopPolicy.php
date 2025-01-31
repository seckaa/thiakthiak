<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{


    //for admin only
    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    // all users
    public function browse(User $user)
    {
        return $user->hasRole('seller');
    }


    public function read(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    public function edit(User $user, Shop $shop)
    {

        return $user->id == $shop->user_id;
    }

    public function add(User $user)
    {
        //
    }

    public function delete(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Shop $shop): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, Shop $shop): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete(User $user, Shop $shop): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Shop $shop): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Shop $shop): bool
    // {
    //     //
    // }
}
