<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;

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
        Route::view('/login', 'admin.auth.login')->name('login.form');  
        Route::post('/login', [LoginController::class, 'login'])->name('login');

        Route::view('/register', 'admin.auth.register')->name('register.form'); 
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/top', [TopController::class, 'index'])->name('top'); 

        Route::get('/culliculum', function () {
            return view('admin.culliculum_list');
        })->name('culliculum');
    
        Route::get('/article', function () {
            return view('admin.article_list');
        })->name('article');

        Route::get('/banner', [BannerController::class, 'index'])->name('banner');
        Route::post('/banner/upload', [BannerController::class, 'upload'])->name('banner.upload');
        Route::delete('/banner/delete/{filename}', [BannerController::class, 'delete'])->name('banner.delete');

        Route::get('/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    });

    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        request()->session()->invalidate(); // セッション無効化
        request()->session()->regenerateToken(); // CSRFトークン再生成
        return redirect()->route('admin.login');
    })->name('logout');

});


Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('guest:user')->group(function () {
        Route::view('/login', 'user.auth.login')->name('login.form');  
        Route::post('/login', [LoginController::class, 'login'])->name('login');

        Route::view('/register', 'user.auth.register')->name('register.form'); 
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('/top', [TopController::class, 'index'])->name('top'); 

        Route::get('/culliculum', function () {
            return view('user.culliculum_list');
        })->name('culliculum');
    
        Route::get('/article', function () {
            return view('user.article_list');
        })->name('article');

        Route::get('/banner', [BannerController::class, 'index'])->name('banner');
        Route::post('/banner/upload', [BannerController::class, 'upload'])->name('banner.upload');
        Route::delete('/banner/delete/{filename}', [BannerController::class, 'delete'])->name('banner.delete');

        Route::get('/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    });

    Route::post('/logout', function () {
        Auth::guard('user')->logout();
        request()->session()->invalidate(); // セッション無効化
        request()->session()->regenerateToken(); // CSRFトークン再生成
        return redirect()->route('user.login');
    })->name('logout');
});