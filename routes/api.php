<?php

use App\Http\Controllers\Api\CategoryService;
use App\Http\Controllers\api\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryService::class)->prefix('/category')->group(function(){
    Route::get('/', 'get');
    Route::get('/{id?}', 'detail');
    Route::post('/', 'store');
    Route::put('/{id?}', 'update');
    Route::delete('/{id?}', 'destroy');
});

Route::controller(NewsService::class)->prefix('/news')->group(function(){
    Route::get('/', 'get');
    Route::get('/{id?}', 'detail');
    Route::post('/', 'store');
    Route::put('/{id?}', 'update');
    Route::delete('/{id?}', 'destroy');
});