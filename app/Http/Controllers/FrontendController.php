<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function category()
    {
        $categories = Category::orderby('id', 'desc')->get();
        return view('frontend.category', compact('categories'));
    }
    public function categoryDetails(Category $id)
    {
        // dd($id);
        $categories = Category::find($id);
        return view('frontend.categoryDetails', compact('categories'));
    }
}
