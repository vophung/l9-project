<?php

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

Route::controller(LoginController::class)->name('login.')->group(function() {
    Route::get('/login', 'index')->name('index');
    Route::post('/login', 'store')->name('store');
});

Route::controller(RegisterController::class)->name('register.')->group(function() {
    Route::get('/register', 'index')->name('index');
    Route::post('/register', 'store')->name('store');
});