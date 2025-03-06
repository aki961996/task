<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\FrontEndController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    // product api
    Route::get('product/orderDetail/{id}', 'order_detail')->name('products.orderDetails');
    Route::post('product/add_cart/{id}', 'add_cart')->name('add_cart');

    //show_cart
    Route::get('product/show_cart', 'show_cart')->name('show_cart');

    //remove_cart
    Route::get('/remove_cart/{id}',  'remove_cart')->name('remove_cart');

    //cash on delivary api
    Route::get('/cash_order',  'cash_order')->name('cash_order');

    Route::post('/session', 'checkout')->name('session');

    //stripe
    Route::get('/charge_stripe', 'charge_stripe')->name('charge_stripe');

    Route::post('/session', 'checkout')->name('session');

    Route::get('/success',  'success')->name('success');
    //stripe api end
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('export', [UserController::class, 'export'])->name('users.export');
    Route::get('orders/pdf', [UserController::class, 'pdf'])->name('users.pdf');

    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
