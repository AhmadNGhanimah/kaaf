<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\CartComponent;
use App\Http\Livewire\User\CategoryComponent;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\User\Checkout;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Other Routes
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User Routes


Route::get('/category', [CategoryComponent::class, 'index'])->name('category.all');
Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', function () {
        return view('pages.cart');
    })->name('cart.index');
});
// End User Routes

//  Admin Routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category', 'store')->name('category.store');
        Route::get('/category/{category_id}/edit', 'edit')->name('category.edit');
        Route::put('/category/{category_id}', 'update')->name('category.update');
        Route::delete('/category/{category_id}', 'delete')->name('category.delete');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/{id}', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
    });
});
//  End Admin Routes
