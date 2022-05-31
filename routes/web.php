<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentOutController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category', CategoryController::class);
Route::resource('/item', ItemController::class);
Route::resource('/rentout', RentOutController::class);
Route::resource('/payment', PaymentController::class);
Route::get('/categories', [App\Http\Controllers\ItemController::class, 'getAllCategories'])->name('categories');
Route::get('/items', [App\Http\Controllers\ItemController::class, 'getAllItems'])->name('items');
Route::get('/get-item', [App\Http\Controllers\ItemController::class, 'getSingleItem'])->name('get_item');
Route::get('/get-order-details', [App\Http\Controllers\RentOutController::class, 'getOrderDetails'])->name('order_details');



