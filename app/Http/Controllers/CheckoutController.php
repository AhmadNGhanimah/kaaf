<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        $cartItems = Cart::where('user_id', Auth::id())->with('category')->get();


        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->category->price * $item->quantity;
        }

        return view('frontend.checkout', compact('totalAmount', 'cartItems'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('category')->get();
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->category->price * $item->quantity;
        }
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fullname = $request->fullname;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->total_amount = $totalAmount;
        $order->payment_method = 'Cash on Delivery';
        $order->save();
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.success');
    }
    public function success()
    {
        return view('frontend.checkout-success');
    }
}
