<?php

use App\Http\Controllers\ProductController;
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

Route::redirect('/', '/login');
#Ida Nee mak Route husi Controller AuthController
Route::get('login',[\App\Http\Controllers\AuthController::class,'index'])->name('login');
Route::post('auth\login',[\App\Http\Controllers\AuthController::class,'dologin'])->name('dologin');
#

Route::group(['middleware' => 'auth'], function(){
#1)Dashboard
Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');
#EndDashboard

#DeliverOrder
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transactions', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.create');
    Route::get('/transactions/{id}/edit', [\App\Http\Controllers\TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.destroy');
#End Delivery Order



#3) Client
Route::get('clients',[\App\Http\Controllers\ClientController::class,'index'])->name('client.index');
Route::post('clients',[\App\Http\Controllers\ClientController::class,'create'])->name('client.create');
Route::delete('clients/{id}',[\App\Http\Controllers\ClientController::class,'destroy'])->name('client.destroy');
Route::get('clients/{id}',[\App\Http\Controllers\ClientController::class,'edit'])->name('client.edit');
Route::put('clients/{id}',[\App\Http\Controllers\ClientController::class,'update'])->name('client.update');
#End Client


#4) Product Controller
Route::get('products',[\App\Http\Controllers\ProductController::class,'index'])->name('product.index');
Route::post('products',[\App\Http\Controllers\ProductController::class,'store'])->name('product.store');
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
#End Products Controller



#5) Ida nee AuthController
Route::get('users',[\App\Http\Controllers\AuthController::class,'users'])->name('users.list');
Route::post('user',[\App\Http\Controllers\AuthController::class,'store'])->name('user.store');
Route::delete('user/{id}',[\App\Http\Controllers\AuthController::class,'destroy'])->name('user.destroy');
Route::get('users/{id}',[\App\Http\Controllers\AuthController::class,'edit'])->name('user.edit');
Route::put('user/{id}',[\App\Http\Controllers\AuthController::class,'update'])->name('user.update');
Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
#End AuthController

#Logs Controller
Route::get('user-logs',[\App\Http\Controllers\LogsController::class,'index'])->name('logs.index');

#End LogsCOntroller




});












