<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{


    public $cartItems;

    public function index()
    {
        return view('pages.cart');
    }
    public function mount()
    {
        $this->cartItems = Cart::where('user_id', Auth::id())->with('category')->get();
    }
    public function calculateTotal()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->category->price * $item->quantity;
        });
    }
    public function updateQuantity($id, $quantity)
    {
        $cartItem = Cart::find($id);
        $cartItem->quantity = $quantity;
        $cartItem->save();

        $this->mount();
    }

    public function removeItem($id)
    {
        Cart::destroy($id);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.user.cart-component', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
