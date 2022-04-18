<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Execution\CartController;
use App\Http\Controllers\Execution\UploadImagesController;
use App\Http\Controllers\Socialite\LoginController as SocialiteLoginController;
use App\Http\Controllers\Themes\NavigationController;
use App\Http\Controllers\User\ForgotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;

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

Route::controller(NavigationController::class)->name('navigation.')->group(function() {
    Route::get('index', 'home_page')->name('home_page');
    Route::get('shop', 'shop_page')->name('shop_page');
    Route::get('product-details/{slug}', 'product_detail')->name('product_detail');
    Route::get('shop/{slug}', 'shop_slug')->name('shop-slug');
});

Route::controller(AccountController::class)->name('account.')->group(function() {
    Route::get('account', 'index')->name('index');
    Route::post('account', 'store')->name('store');
});

Route::controller(CartController::class)->name('cart.')->group(function() {
    Route::post('cart','store')->name('store');
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
    Route::resource('product', ProductController::class);
    Route::get('/product/create/{id}/upload-images', [UploadImagesController::class, 'upload_images_product'])->name('product.uploads');
    Route::post('/product/create/{id}/upload-images/store', [UploadImagesController::class, 'upload_images_product_store'])->name('product.uploads.store');
    Route::get('/product/create/{id}/upload-images/edit', [UploadImagesController::class, 'upload_images_product_edit'])->name('product.uploads.edit');;
    Route::post('/product/create/{id}/upload-images/update', [UploadImagesController::class, 'upload_images_product_update'])->name('product.uploads.update');
    Route::get('/product/set/images/{id}/upload-images', [UploadImagesController::class, 'set_upload_images_product'])->name('product.uploads.set');
    Route::post('/product/set/images/{id}/upload-images/store', [UploadImagesController::class, 'set_upload_images_product_store'])->name('product.uploads.set.store');
    Route::get('/product/set/images/{id}/upload-images/edit', [UploadImagesController::class, 'set_upload_images_product_edit'])->name('product.uploads.set.edit');
    Route::post('/product/set/images/{id}/upload-images/update', [UploadImagesController::class, 'set_upload_images_product_update'])->name('product.uploads.set.update');
    Route::post('getProduct', [ProductController::class, 'getProduct'])->name('product.getProduct');
});

Route::get('/login/google/redirect', [SocialiteLoginController::class, 'redirect'])->name('google.redirect');
Route::get('/login/google/callback', [SocialiteLoginController::class, 'callback'])->name('google.callback');

Route::get('/login/facebook/redirect', [SocialiteLoginController::class, 'redirectFB'])->name('facebook.redirect');
Route::get('/login/facebook/callback', [SocialiteLoginController::class, 'callbackFB'])->name('facebook.callback');

Route::get('/verify', [RegisterController::class, 'verifyUser'])->name('verify.user');
Route::get('/verify?code={code}')->name('verify.code');
