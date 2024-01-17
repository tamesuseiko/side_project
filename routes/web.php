<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::group(['middleware' => ['Webpanel']], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // รายการสินค้า
    Route::prefix('product')->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
        Route::get('add', [App\Http\Controllers\ProductController::class, 'add'])->middleware('Admin');
        Route::post('insert', [App\Http\Controllers\ProductController::class, 'insert'])->middleware('Admin');
        Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->where(['id' => '[0-9]+'])->middleware('Admin');
        Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'update'])->where(['id' => '[0-9]+'])->middleware('Admin');
        Route::post('destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('Admin');
        Route::post('datatable', [App\Http\Controllers\ProductController::class, 'datatable']);
    });

    // ขอสินค้า
    Route::prefix('request_product')->group(function () {
        Route::get('/', [App\Http\Controllers\RequestProductController::class, 'index']);
        Route::get('add', [App\Http\Controllers\RequestProductController::class, 'add']);
        Route::post('insert', [App\Http\Controllers\RequestProductController::class, 'insert']);
        Route::post('destroy', [App\Http\Controllers\RequestProductController::class, 'destroy']);
        Route::post('datatable', [App\Http\Controllers\RequestProductController::class, 'datatable']);
        Route::get('/{id}/show_modal', [App\Http\Controllers\RequestProductController::class, 'show_modal'])->where(['id' => '[0-9]+']);
        Route::get('/sendmail/{id}', [App\Http\Controllers\RequestProductController::class, 'sendmail'])->where(['id' => '[0-9]+']);
    });


});

