<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// End Other Routes

// Cart Routes
route::middleware('auth')->group(function () {
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout', 'store')->name('checkout.store');
        Route::get('/checkout/success', 'success')->name('checkout.success');
    });
});
// End Cart Routes

//  User Routes
route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend.index');
    Route::get('/category', 'category')->name('frontend.category');
    Route::get('/category/details/{id}', 'categoryDetails')->name('frontend.categoryDetails');
});

route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::patch('/cart/update/{cartId}', 'update')->name('cart.update');
    Route::delete('/cart/remove/{cartId}', 'remove')->name('cart.remove');
    Route::post('/cart/add/{categoryId}', 'addToCart')->name('cart.add');
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
