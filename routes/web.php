<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\NewsController;

Route::resource('categories', categoryController::class);
// route::get(uri: '/categories', action:[categoryController::class, 'index']);

Route::resource('news', NewsController::class);

Route::get('/', function () {
    return view('layouts.Beranda');
});

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
route::get(uri: '/dashboard', action:[DashboardController::class, 'dashboard']);
route::get(uri: '/', action:[BerandaController::class, 'index']);

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

Route::get('/login', function () {
    return view('layouts.Admin.login');
});

Route::get('/password', function () {
    return view('layouts.Admin.password');
});

Route::get('/register', function () {
    return view('layouts.Admin.register');
});

Route::get('/404', function () {
    return view('layouts.Admin.404');
});

Route::get('/401', function () {
    return view('layouts.Admin.401');
});

Route::get('/500', function () {
    return view('layouts.Admin.500');
});