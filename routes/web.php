<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DeliveryController;

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

    Route::get('/curriculum_create',[CurriculumController::class,'showCurriculumCreate'])->name('show.curriculum.create');
    Route::post('/curriculum_store',[CurriculumController::class,'exeCurriculumStore'])->name('exe.curriculum.store');
    
    Route::get('/curriculum_edit/{id}',[CurriculumController::class,'showCurriculumEdit'])->name('show.curriculum.edit');
    Route::post('/curriculum_update/{id}',[CurriculumController::class,'exeCurriculumUpdate'])->name('exe.curriculum.update');

    Route::get('/curriculum_filter', [CurriculumController::class, 'filterCurriculums'])->name('curriculums.filter');

    Route::get('/delivery_edit/{id}', [DeliveryController::class, 'showDeliveryEdit'])->name('show.delivery.edit');

    Route::post('/delivery_store/{id}',[DeliveryController::class,'exeDeliveryStore'])->name('exe.delivery.store');

    Route::delete('/delivery_destroy/{id}',[DeliveryController::class,'exeDeliveryDestroy'])->name('exe.delivery.destroy');
    
});

