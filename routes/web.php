<?php

use App\Http\Controllers\GamePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

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

// Profile pages
Route::get('/profile/{user}',         [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit',    [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');

// ── Auth ─────────────────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

