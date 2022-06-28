<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;



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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [\App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [\App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');



Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');
Route::post('/checkout/callback', [\App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [\App\Http\Controllers\CartController::class, 'success'])->name('success');
Route::get('/register/success', [\App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');

Route::group(['middleware' => 'auth'], function(){
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [\App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard-products');
    Route::get('/dashboard/products/{id}', [\App\Http\Controllers\DashboardProductController::class, 'detail'])->name('dashboard-products-details');
    Route::post('/dashboard/products/{id}', [\App\Http\Controllers\DashboardProductController::class, 'update'])->name('dashboard-products-update');
    Route::post('/dashboard/products/gallery/upload', [\App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])->name('dashboard-products-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [\App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])->name('dashboard-products-gallery-delete');
    Route::get('/dashboard/products-create', [\App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-products-create');
    Route::post('/dashboard/products', [\App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-products-store');
    Route::get('/dashboard/transactions', [\App\Http\Controllers\DashboardTransactionsController::class, 'index'])->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id?}', [\App\Http\Controllers\DashboardTransactionsController::class, 'detail'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id?}', [\App\Http\Controllers\DashboardTransactionsController::class, 'update'])->name('dashboard-transactions-update');
    Route::get('/dashboard/settings', [\App\Http\Controllers\DashboardAccountController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/dashboard/account', [\App\Http\Controllers\DashboardAccountController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [\App\Http\Controllers\DashboardAccountController::class, 'update'])->name('dashboard-settings-redirect');
});
Route::prefix('admin')
->namespace('Admin')
->middleware(['auth', 'admin'])
->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
    Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
    Route::resource('user', '\App\Http\Controllers\Admin\UserController');
    Route::resource('product', '\App\Http\Controllers\Admin\ProductController');
    Route::resource('product-gallery', '\App\Http\Controllers\Admin\ProductGalleryController');
    Route::resource('transaction', '\App\Http\Controllers\Admin\TransactionController');
});

Auth::routes();