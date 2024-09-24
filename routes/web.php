<?php

use App\Http\Livewire\User\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\CartComponent;
use App\Http\Controllers\AdminAuthController;
use App\Http\Livewire\User\CategoryComponent;
use App\Http\Controllers\Admin\UserController;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User Routes


Route::get('/', [CategoryComponent::class, 'index'])->name('category.all');
Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', function () {
        return view('pages.cart');
    })->name('cart.index');
});
// End User Routes

// Admin Start
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.post');

        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::middleware('isAdmin')->group(function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category', 'index')->name('admin.category');
                Route::get('/category/create', 'create')->name('admin.category.create');
                Route::post('/category', 'store')->name('admin.category.store');
                Route::get('/category/{category_id}/edit', 'edit')->name('admin.category.edit');
                Route::put('/category/{category_id}', 'update')->name('admin.category.update');
                Route::delete('/category/{category_id}', 'delete')->name('admin.category.delete');
            });
            Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
            Route::post('/users/{id}', [UserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');
        });
    });
});
// Admin End
