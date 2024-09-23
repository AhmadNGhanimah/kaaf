<?php

namespace App\Http\Livewire\User;

use App\Models\Category;
use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $priceInput = 'low-to-high';

    public function index()
    {
        return view('pages.category');
    }

    public function render()
    {
        $categories = Category::query()
            ->orderBy('price', $this->priceInput === 'high-to-low' ? 'desc' : 'asc')
            ->paginate(9);

        return view('livewire.user.category-component', ['categories' => $categories]);
    }

    public function addToCart($categoryId)
    {
        if (!auth()->check()) {
            session()->flash('message', 'You need to be logged in to add items to the cart.');
            return;
        }
        $cartItem = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'category_id' => $categoryId,
        ]);
        $cartItem->increment('quantity');
        session()->flash('success', 'Item added to cart!');
        $this->updateCartCount();
    }
}
