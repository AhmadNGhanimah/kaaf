<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $priceInput = 'low-to-high';
    public $arrivelInput = 'newest';

    public function updatedPriceInput()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::query();

        // Created At
        if ($this->arrivelInput == 'newest') {
            $categories = $categories->orderBy('created_at', 'desc');
        } elseif ($this->arrivelInput == 'oldest') {
            $categories = $categories->orderBy('created_at', 'asc');
        }

        // Price
        if ($this->priceInput == 'high-to-low') {
            $categories = $categories->orderBy('price', 'desc');
        } else {
            $categories = $categories->orderBy('price', 'asc');
        }

        return view('livewire.category-component', [
            'categories' => $categories->paginate(9),
        ]);
    }
}
