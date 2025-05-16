<?php

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

//Auth::routes();

Route::group(['prefix' => 'User'], function() {
    Route::get('/login', [App\Http\Controllers\User\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\User\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\User\LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [App\Http\Controllers\User\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\User\RegisterController::class, 'register']);

    //今回は不要なパスワードリセット機能やメール認証を使用する場合の追加ルート
    //パスワードリセット
    //Route::get('password/reset', [App\Http\Controllers\User\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    //Route::post('password/email', [App\Http\Controllers\User\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    //Route::get('password/reset/{token}', [App\Http\Controllers\User\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    //Route::post('password/reset', [App\Http\Controllers\User\ResetPasswordController::class, 'reset'])->name('password.update');
    //メール認証
    //Route::get('email/verify', [App\Http\Controllers\User\VerificationController::class, 'notice'])->name('verification.notice');
    //Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\User\VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed', 'throttle:6,1']);
    //Route::post('email/resend', [App\Http\Controllers\User\VerificationController::class, 'resend'])->name('verification.resend')->middleware('throttle:6,1');
});

Route::group(['prefix' => 'admin'], function() {
    Route::view('/login', 'admin/login');
    Route::post('/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
    Route::view('/register', 'admin/register');
    Route::post('/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
});

Route::group(['prefix' => 'User', 'middleware' => 'auth'], function () {
    Route::get('/usersTop', [App\Http\Controllers\User\ProfileController::class, 'usersTop'])->name('usersTop');
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'usersEdit'])->name('usersEdit');
    Route::put('/usersUpdate/{id}',  [App\Http\Controllers\User\ProfileController::class, 'usersUpdate'])->name('usersUpdate');
    Route::get('/usersPassEdit', [App\Http\Controllers\User\ProfileController::class, 'usersPassEdit'])->name('usersPassEdit');
    Route::put('/usersPassUpdate/{id}', [App\Http\Controllers\User\ProfileController::class, 'usersPassUpdate'])->name('usersPassUpdate');
    Route::get('/articlesDetail/{id}', [App\Http\Controllers\User\ArticleController::class, 'articlesDetail'])->name('articlesDetail');
    Route::get('/userProgress', [App\Http\Controllers\User\ProgressController::class, 'userProgress'])->name('userProgress');
});

Route::group(['prefix' => 'admin','middleware' => 'auth:admin'],function () {
    Route::view('/home', 'admin/home');
    Route::view('/adminTop', 'admin/top')->name('adminTop');
    Route::get('/article_list', [App\Http\Controllers\admin\ArticleController::class, 'articlesList'])->name('article_list');
    Route::view('/article_create', 'admin/article_create')->name('article_create');
    Route::post('/articlesRegister', [App\Http\Controllers\admin\ArticleController::class, 'articlesRegister'])->name('articlesRegister');
    Route::get('/articles_edit/{id}', [App\Http\Controllers\admin\ArticleController::class, 'articlesEdit'])->name('articles_edit');
    Route::put('/articles_update/{id}', [App\Http\Controllers\admin\ArticleController::class, 'update'])->name('articles_update');
    Route::delete('/articles_delete/{id}', [App\Http\Controllers\admin\ArticleController::class, 'articlesDelete'])->name('articles_delete');


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
