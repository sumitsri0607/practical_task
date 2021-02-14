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

Route::group(['middleware' => 'auth'], function () {
    // Admin Access//
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('user.list');
    Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('user.create');
    Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('user.store');
    Route::get('/admin/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('user.edit');
    Route::post('/admin/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('user.update');
    Route::get('/admin/destroy/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('user.destroy');
    // Product//
    Route::get('/product/index', [App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::get('/product/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
});
    
