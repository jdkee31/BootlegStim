<?php

use App\Http\Controllers\GamePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PaymentController;

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

Route::get('/games/{game}', [GamePageController::class, 'show'])->name('games.show');

//Route::middleware(['auth'])->group(function () {
 
    // ---- Game Library ----
    Route::get('/library', [LibraryController::class, 'libraryPage'])->name('library.libraryPage');
    Route::get('/library/{id}', [LibraryController::class, 'show'])->name('library.show');
 
    // ---- Payment / Checkout ----
    Route::get('/checkout', [PaymentController::class, 'paymentPage'])->name('payment.paymentPage');
    Route::post('/checkout/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/checkout/promo', [PaymentController::class, 'applyPromo'])->name('payment.promo');
    Route::post('/checkout/wallet', [PaymentController::class, 'toggleWallet'])->name('payment.wallet.toggle');
//});
