<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    Route::resource('/products', ProductController::class);
});
