<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::view('/login', 'admin.auth.login')->name('login');  
        Route::post('/login', [LoginController::class, 'login']);

        Route::view('/register', 'admin.auth.register')->name('register'); 
        Route::post('/register', [RegisterController::class, 'register']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::view('/top', 'admin.top')->name('top'); 
    });

    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    })->name('logout');

});