<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CurriculumController;

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
Route::view('/admin/login', 'admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
Route::view('/admin/register', 'admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
Route::view('/admin/home', 'admin/home')->middleware('auth:admin');

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/curriculum_list',[CurriculumController::class,'showCurriculumList'])->name('show.curriculum.list');
    Route::get('/curriculum_list/{grade_id}', [CurriculumController::class, 'showCurriculumByGrade'])->name('curriculum.by_grade');
});

