<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\User\TopController as UserTopController;
use App\Http\Controllers\User\CurriculumController;

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

Route::get('/home', function () {
    return redirect('/user/top'); 
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::view('/login', 'admin.auth.login')->name('login.form');  
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login');

        Route::view('/register', 'admin.auth.register')->name('register.form'); 
        Route::post('/register', [AdminRegisterController::class, 'register'])->name('register');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/top', [AdminTopController::class, 'index'])->name('top'); 

        Route::get('/curriculum', function () {
            return view('admin.curriculum_list');
        })->name('curriculum');
    
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
        Route::post('/login', [UserLoginController::class, 'login'])->name('login');

        Route::view('/register', 'user.auth.register')->name('register.form'); 
        Route::post('/register', [UserRegisterController::class, 'register'])->name('register');
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('/top', [UserTopController::class, 'index'])->name('top'); 

        Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum_list');
        
        
        Route::get('/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    });

    

    Route::post('/logout', function () {
        Auth::guard('user')->logout();
        request()->session()->invalidate(); // セッション無効化
        request()->session()->regenerateToken(); // CSRFトークン再生成
        return redirect()->route('user.login.form');
    })->name('logout');
});