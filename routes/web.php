<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
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

Route::get('/', [UserController::class, 'all'] )->name('user.all');
Route::get('/users', [UserController::class, 'all'] )->name('user.all');
Route::post('/user/store', [UserController::class, 'store'] )->name('user.store');
Route::post('/user/assign', [UserController::class, 'assign'] )->name('user.assign');

Route::get('/customers', [CustomerController::class, 'all'] )->name('customer.all');
Route::post('/customer/store', [CustomerController::class, 'store'] )->name('customer.store');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
