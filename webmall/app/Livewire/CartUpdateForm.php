<?php

namespace App\Livewire;

use Livewire\Component;

class CartUpdateForm extends Component
{
    public $item = [];

    public $quantity = 0;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Livewire\Component::macro('emit', function ($event) {
            $this->dispatch($event);
        });
    }

    /// must have item passed from view
    public function mount($item)
    {
        $this->item = $item;

        $this->quantity = $item['quantity'];
    }


    public function updateCart()
    {

        // dd("upadting cart");
        \Cart::session(auth()->id())->update($this->item['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);

        // dd(('cartUpdated'));
        $this->emit('cartUpdated');
    }
    public function render()
    {
        return view('livewire.cart-update-form');
    }
}
