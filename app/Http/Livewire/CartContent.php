<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartContent extends Component
{
   
     public $quantity=0;

     public function incrementQuantity($rowID, $qty): void
    {
        $this->quantity = $qty;
        $qty++;
        Cart::update($rowID, $qty);
        $this->emit('incrementQuantity');
    }

     public function decrementQuantity($rowID, $qty): void
    {
        $this->quantity = $qty;
        $qty--;
        Cart::update($rowID, $qty);
        $this->emit('decrementQuantity');
    }
    public function removeFromCart($productId): void
    {
        Cart::remove($productId);
        $this->emit('removeFromCart');
    }

    public function render()
    {
        $rows  = Cart::content();
        
        $products = [];
        foreach($rows as $row){
            $products[]= Product::where('id', $row->id)->get();
            
        }
       
        return view('livewire.cart-content', compact('rows', 'products'));
    }

   
}
