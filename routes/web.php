<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Shopping\CartController;
use App\Http\Controllers\Shopping\ProductController;
use App\Http\Controllers\Socialite\LoginController as SocialiteLoginController;
use App\Http\Controllers\User\ForgotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Jobs\NewJob;

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

Route::controller(ProductController::class)->name('product.')->group(function(){
    Route::get('/product', 'index')->name('index');
});

Route::controller(CartController::class)->name('cart.')->group(function(){
    Route::get('/cart', 'index')->name('index');
    Route::post('/cart', 'store')->name('store');
    Route::post('/update', 'update')->name('update');
    Route::post('/delete', 'destroy')->name('destroy');
    Route::post('/clear', 'clear')->name('clear');
});

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginController::class)->name('login.')->group(function() {
    Route::get('/login', 'index')->name('index');
    Route::post('/login', 'store')->name('store');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->name('register.')->group(function() {
    Route::get('/register', 'index')->name('index');
    Route::post('/register', 'store')->name('store');
});

Route::controller(ForgotController::class)->name('password.')->group(function() {
    Route::get('/forgot-password','index')->name('index');
    Route::any('/password/reset/{token}/email={email}','reset')->name('reset');
    Route::post('/forgot-password','email')->name('email');
    Route::post('/password/reset','update')->name('update');
});

Route::controller(DashboardController::class)->middleware(['checkLogin'])->name('admin.')->group(function() {
    Route::get('/dashboard', 'index')->name('index');
});

Route::middleware(['checkLogin'])->group(function() {
    Route::resource('category', CategoryController::class);
});

Route::get('/login/google/redirect', [SocialiteLoginController::class, 'redirect'])->name('google.redirect');
Route::get('/login/google/callback', [SocialiteLoginController::class, 'callback'])->name('google.callback');

Route::get('/login/facebook/redirect', [SocialiteLoginController::class, 'redirectFB'])->name('facebook.redirect');
Route::get('/login/facebook/callback', [SocialiteLoginController::class, 'callbackFB'])->name('facebook.callback');

Route::get('/verify', [RegisterController::class, 'verifyUser'])->name('verify.user');
Route::get('/verify?code={code}')->name('verify.code');
