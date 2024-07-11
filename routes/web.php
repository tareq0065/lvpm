<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('checkout', [CheckoutController::class, 'create'])
    ->name('checkout.create');
Route::post('paymentIntent', [CheckoutController::class, 'paymentIntent'])
    ->name('checkout.paymentIntent');
Route::resource('products', ProductController::class);
Route::get('shoppingCart', [CartController::class, 'index'])
    ->name('cart.index');

Route::resource('orders', OrderController::class);

Route::get('/clear', function () {
    \Cart::session(auth()->user()->id)->clear();
});

Route::get('/dashboard', function () {
    $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth'])->name('dashboard');

Route::get('/thankyou', fn() => 'Thanks for purchasing from us!');

require __DIR__.'/auth.php';
