<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('product/{id}', [HomeController::class, 'details'])->name('details');
Route::post('add/to/cart', [HomeController::class, 'addTocart'])->name('addTocart');
Route::get('cart', [HomeController::class, 'cart'])->middleware('auth')->name('cart');
Route::get('checkout', [HomeController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::post('confurm/order', [HomeController::class, 'confurm_order'])->middleware('auth')->name('confurm_order');
Route::get('your/orders', [HomeController::class, 'your_orders'])->middleware('auth')->name('your_orders');


