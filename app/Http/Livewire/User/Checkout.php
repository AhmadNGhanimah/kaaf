<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Checkout extends Component
{
    public $fullname;
    public $phone;
    public $email;
    public $address;
    public $total;


    public function index()
    {
        return view('pages.checkout');
    }
    public function mount()
    {
        $this->calculateTotal();
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function placeOrder()
    {

        Cart::where('user_id', Auth::id())->delete();
        Session::flash('success', 'Order is complete! We will contact you soon for confirmation.');
        return redirect()->route('category.all');
    }

    public function calculateTotal()
    {
        $this->total = Cart::where('user_id', Auth::id())->with('category')->get()->sum(function ($item) {
            return $item->category->price * $item->quantity;
        });
    }

    public function render()
    {
        return view('livewire.user.checkout');
    }
}
