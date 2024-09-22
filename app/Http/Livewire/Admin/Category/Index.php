<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $category_id;

    public function confirmDelete($category_id)
    {
        $this->category_id = $category_id;
    }

    public function deleteCategory()
    {
        $category = Category::find($this->category_id);

        if ($category) {

            $path = 'uploads/category/' . $category->image;
            if (file_exists($path)) {
                File::delete($path);
            }

            $category->delete();

            session()->flash('success', 'Category deleted successfully');
            $this->category_id = null;

            // Just For Make refresh to fix modal issue not hide
            return redirect()->route('category');
        }
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.admin.category.index', compact('categories'));
    }
}
