<?php

use App\Http\Controllers\CartPageController;
use App\Http\Controllers\GamePageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestDataController;
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

Route::get('/', function () {
    return view('welcome');
});

// game page route
Route::get('/games/{game}', [GamePageController::class, 'show'])->name('games.show');

// cart page routes (DB-backed via user_carts)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartPageController::class, 'show'])->name('cart.show');
    Route::get('/cart/data', [CartPageController::class, 'data'])->name('cart.data');
    Route::post('/cart/calculate-totals', [CartPageController::class, 'calculateTotals']);
    Route::post('/cart/remove-item', [CartPageController::class, 'removeItem']);
    Route::post('/cart/clear', [CartPageController::class, 'clearCart']);
    Route::post('/cart/update-quantity', [CartPageController::class, 'updateQuantity']);
});

// test data routes (for development/testing React setup)
Route::prefix('test')->name('test.')->middleware('auth')->group(function () {
    Route::get('/populate-cart', [TestDataController::class, 'populateCart'])->name('populate-cart');
    Route::get('/clear-cart', [TestDataController::class, 'clearTestCart'])->name('clear-cart');
    Route::get('/cart-status', [TestDataController::class, 'cartStatus'])->name('cart-status');
});

// authentication routes
Auth::routes();

// home page route after login
Route::get('/home', [HomeController::class, 'index'])->name('home');