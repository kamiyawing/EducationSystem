<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Auth\ConfirmPasswordController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\VerificationController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\DeliveryController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BannerController;

// 認証関連のルートAuth::routes(); 

Route::prefix('user')->group(function () {
    // ログイン
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // ログアウト
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // 新規会員登録のルートをカスタムで定義
    //Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('new.register');
    Route::view('/register','user.auth.register')->name('user.register');


    // ユーザーのメインページ
    Route::get('/home', [TopController::class, 'index'])->name('home');

    // 記事・カリキュラム・進捗管理系
    Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('show.article');
    Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
    Route::get('/curriculums/{curriculum}/edit', [CurriculumController::class, 'edit'])->name('curriculums.edit');
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    Route::post('/curriculums/filter/{grade}', [CurriculumController::class, 'filterByGrade'])
        ->name('curriculums.filterByGrade');
        
    // プロフィール・設定系
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // バナー管理系
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banner/switchBanner', [BannerController::class, 'switchBanner'])->name('banner.switch');


    // 配信
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::get('/delivery/{id}', [DeliveryController::class, 'show'])->name('delivery.show');
    Route::get('/delivery/watch/{id}', [DeliveryController::class, 'watch'])->name('delivery.watch');
    Route::post('/delivery/complete/{id}', [DeliveryController::class, 'complete'])->name('delivery.complete');


    Route::get('/confirm-password', [App\Http\Controllers\User\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('/confirm-password', [App\Http\Controllers\User\Auth\ConfirmPasswordController::class, 'confirm']);

  
});















// Route::prefix('user')->namespace('user')->name('user.')->group(function () {
//     // ログイン画面
//     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    // // ユーザー新規登録画面
    // Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

    // // トップページ
    // Route::get('/top', [TopController::class, 'showTop'])->name('top');

    // // お知らせ詳細画面
    // Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('article');

    // // 授業一覧画面
    // Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('curriculum');

    // // 配信画面
    // Route::get('/delivery/{id}', [DeliveryController::class, 'showDelivery'])->name('delivery');

    // // 授業進捗画面
    // Route::get('/progress', [ProgressController::class, 'showProgress'])->name('progress');

    // // プロフィール設定画面
    // Route::get('/profile', [ProfileController::class, 'showProfileForm'])->name('profile');

    // // パスワード設定画面
    // Route::get('/password', [ProfileController::class, 'showPasswordForm'])->name('password.edit');
// });