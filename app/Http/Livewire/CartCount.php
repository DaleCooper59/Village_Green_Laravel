<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCount extends Component
{
    protected $listeners = [
        'removeFromCart' => 'render',
        'incrementQuantity' => 'render',
        'decrementQuantity' => 'render',
    ];
    public function render()
    {
        $cart_count = Cart::count();
        return view('livewire.cart-count', compact('cart_count'));
    }
}
