<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {

        $cartItems = Cart::where('user_id', Auth::id())->with('category')->get();
        return view('frontend.cart', compact('cartItems'));
    }
    public function getCartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return $cartCount;
    }
    public function addToCart(Request $request, $categoryId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('category_id', $categoryId)
            ->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'category_id' => $categoryId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }
    public function update(Request $request, Cart $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $cartId->quantity = $request->input('quantity');
        $cartId->save();

        return redirect()->back()->with('success', 'Cart item updated successfully!');
    }


    public function remove(Cart $cartId)
    {
        $cartId->delete();
        return redirect()->back()->with('removed', 'Item removed from cart!');
    }
}
