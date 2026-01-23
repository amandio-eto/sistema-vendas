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

Route::get('/', function () {
    return view('Dashboard.index');
});


#Ida Nee mak Route husi Controller AuthController
Route::get('login',[\App\Http\Controllers\AuthController::class,'index'])->name('Auth.index');
Route::get('users',[\App\Http\Controllers\AuthController::class,'users'])->name('users.list');
#Product Controller
Route::get('products',[\App\Http\Controllers\ProductController::class,'index'])->name('product.index');
Route::post('products',[\App\Http\Controllers\ProductController::class,'store'])->name('product.store');
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
#End Products Controller


#Client
Route::get('clients',[\App\Http\Controllers\ClientController::class,'index'])->name('client.index');
Route::post('clients',[\App\Http\Controllers\ClientController::class,'create'])->name('client.create');
Route::delete('clients/{id}',[\App\Http\Controllers\ClientController::class,'destroy'])->name('client.destroy');
Route::get('clients/{id}',[\App\Http\Controllers\ClientController::class,'edit'])->name('client.edit');
Route::put('clients/{id}',[\App\Http\Controllers\ClientController::class,'update'])->name('client.update');

#End Client




