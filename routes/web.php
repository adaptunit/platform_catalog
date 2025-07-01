<?php

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

Auth::routes();

Route::get('/', function (){
    return redirect('home');
});

Route::prefix('home')->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'category'])->name('category.platform');
});

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::prefix('admin')->group(function (){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_index');
});

Route::prefix('category')->group(function (){
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::post('/', [App\Http\Controllers\CategoryController::class, 'create'])->name('create');
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroy');
});

Route::prefix('platform')->group(function (){
    Route::get('/', [App\Http\Controllers\PlatformController::class, 'index'])->name('platform');
    Route::post('/', [App\Http\Controllers\PlatformController::class, 'create'])->name('create');
    Route::get('/{id}', [App\Http\Controllers\PlatformController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\PlatformController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\PlatformController::class, 'destroy'])->name('destroy');
});

// Route::post('file/upload', [App\Http\Controllers\FileController::class, 'store'])->name('file.upload');
Route::post('upload', [App\Http\Controllers\FileController::class, 'upload'])->name('upload');

Auth::routes();

