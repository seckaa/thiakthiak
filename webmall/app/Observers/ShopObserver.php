<?php

namespace App\Observers;

use App\Mail\ShopActivated;
use App\Models\Shop;
use Illuminate\Support\Facades\Mail;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     */
    public function created(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "updated" event.
     */
    public function updated(Shop $shop): void
    {
        // dd($shop);
        //dd($shop->getOriginal('is_active'), $shop->is_active );

        //check if active column is changed from inactive to active

        if ($shop->getOriginal('is_active') == false && $shop->is_active == true) {

            // dd("shop made active");
            //send mail to customer
            Mail::to($shop->owner)->send(new ShopActivated($shop));

            //change role from customer to seller
            $shop->owner->setRole('seller');
        } else {
            // dd('shop changed to inactive');
            $shop->owner->setRole('user');
        }
    }

    /**
     * Handle the Shop "deleted" event.
     */
    public function deleted(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     */
    public function restored(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     */
    public function forceDeleted(Shop $shop): void
    {
        //
    }
}
