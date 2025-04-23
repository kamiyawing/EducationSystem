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

Auth::routes();

Route::group(['prefix' => 'user'], function() {

});

Route::group(['prefix' => 'admin'], function() {
    Route::view('/login', 'admin/login');
    Route::post('/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
    Route::view('/register', 'admin/register');
    Route::post('/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/usersTop', [App\Http\Controllers\Auth\ProfileController::class, 'usersTop'])->name('usersTop');
    Route::get('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'usersEdit'])->name('usersEdit');
    Route::put('/usersUpdate/{id}',  [App\Http\Controllers\Auth\ProfileController::class, 'usersUpdate'])->name('usersUpdate');
    Route::get('/usersPassEdit', [App\Http\Controllers\Auth\ProfileController::class, 'usersPassEdit'])->name('usersPassEdit');
    Route::put('/usersPassUpdate/{id}', [App\Http\Controllers\Auth\ProfileController::class, 'usersPassUpdate'])->name('usersPassUpdate');
});

Route::group(['middleware' => 'auth:admin'],function () {
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
