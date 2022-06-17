<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentOutController;
use App\Http\Controllers\ReOrderController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category', CategoryController::class);
Route::resource('/item', ItemController::class);
Route::resource('/rentout', RentOutController::class);
Route::resource('/payment', PaymentController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/reorder', ReOrderController::class);
Route::get('/categories', [App\Http\Controllers\ItemController::class, 'getAllCategories'])->name('categories');
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'getAllCustomers'])->name('customers');
Route::get('/items', [App\Http\Controllers\ItemController::class, 'getAllItems'])->name('items');
Route::get('/get-item', [App\Http\Controllers\ItemController::class, 'getSingleItem'])->name('get_item');
Route::get('/get-order-details', [App\Http\Controllers\RentOutController::class, 'getOrderDetails'])->name('order_details');
Route::get('/print-preview/{id}', [App\Http\Controllers\PaymentController::class, 'printPreview'])->name('print_preview');
Route::get('/download-invoice/{id}', [App\Http\Controllers\PaymentController::class, 'downloadInvoice'])->name('download_invoice');
Route::get('/orders', [App\Http\Controllers\PaymentController::class, 'getAllOrders'])->name('orders');
Route::post('/pay-for-order', [App\Http\Controllers\PaymentController::class, 'payForOrder'])->name('pay_for_order');
Route::get('/orders-month-wise', [App\Http\Controllers\HomeController::class, 'getOrdersMonthWise'])->name('orders_month_wise');
Route::get('/sales-item-wise', [App\Http\Controllers\HomeController::class, 'getSalesItemWise'])->name('sales_item_wise');
// Route::get('/reorder-items', [App\Http\Controllers\HomeController::class, 'itemsInReOrderStatus'])->name('items_reorder');
Route::get('/get-customer-details', [App\Http\Controllers\CustomerController::class, 'getCustomerDetails'])->name('customer_details');
Route::put('/update-stock/{id}', [App\Http\Controllers\ReOrderController::class, 'updateStock'])->name('update_stock');
