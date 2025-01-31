<?php

namespace App\Livewire;

use Livewire\Component;

class MallCart extends Component
{
    public $cartItems = [];

    // public $textData = "initial content";
    protected $listeners = ['cartUpdated' => 'onCartUpdate'];

    // initialization
    public function mount()
    {
        //to array for it to work in livewire
        $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
    }


    public function onCartUpdate()
    {

        // $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.mall-cart');
    }
}
