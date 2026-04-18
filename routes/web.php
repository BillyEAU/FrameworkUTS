<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use PHPUnit\Metadata\Group;

// Route::resource('categories', categoryController::class)->middleware('auth');
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::controller(categoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::put('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
    });

    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index')->name('news.index');
        Route::get('/news/create', 'create')->name('news.create');
        Route::get('/news/edit/{id}/{slug}', 'edit')->name('news.edit');
        Route::post('/news/store', 'store')->name('news.store');
        Route::put('/news/{id}/{slug}', 'update')->name('news.update');
        Route::post('/news/upload-img', 'uploadImage')->name('news.uploadImage');
        Route::delete('/news/{id}/{slug}', 'destroy')->name('news.destroy');
    });
});
Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('', 'index')->name('login');
    Route::post('', 'authenticate');
    Route::post('/logout', 'logout')->name('login.logout');
});

Route::controller(RegisterController::class)->prefix('register')->group(function () {
    Route::get('', 'create')->name('register.form');
    Route::post('', 'store')->name('register');
});


route::get(uri: '/dashboard', action: [DashboardController::class, 'dashboard'])->middleware('auth');
route::get(uri: '/', action: [BerandaController::class, 'index'])->name('beranda.index');

Route::get('/layout-sidenav-light', function () {
    return view('layouts.Admin.layout-sidenav-light');
});

Route::get('/layout-static', function () {
    return view('layouts.Admin.layout-static');
});

Route::get('/charts', function () {
    return view('layouts.Admin.charts');
});

Route::get('/tables', function () {
    return view('layouts.Admin.tables');
});

Route::get('/dashboard/login', function () {
    return view('layouts.Beranda.login');
});

Route::get('/password', function () {
    return view('layouts.Admin.password');
});

// Route::get('/register', function () {
//     return view('layouts.Admin.register');
// });

Route::get('/404', function () {
    return view('layouts.Admin.404');
});

Route::get('/401', function () {
    return view('layouts.Admin.401');
});

Route::get('/500', function () {
    return view('layouts.Admin.500');
});
