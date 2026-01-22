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
    return view('Dashboard.index');
});


#Ida Nee mak Route husi Controller AuthController
Route::get('login',[\App\Http\Controllers\AuthController::class,'index'])->name('Auth.index');
Route::get('users',[\App\Http\Controllers\AuthController::class,'users'])->name('users.list');
#Product Controller
Route::get('products',[\App\Http\Controllers\ProductController::class,'index'])->name('product.index');
Route::post('products',[\App\Http\Controllers\ProductController::class,'store'])->name('product.store');

#End Products Controller

#Client
Route::get('client',[\App\Http\Controllers\ClientController::class,'index'])->name('client.index');
Route::post('client',[\App\Http\Controllers\ClientController::class,'create'])->name('client.create');
Route::delete('client/{id}',[\App\Http\Controllers\ClientController::class,'destroy'])->name('client.destroy');
Route::get('client/{id}',[\App\Http\Controllers\ClientController::class,'edit'])->name('client.edit');
Route::put('client/{id}',[\App\Http\Controllers\ClientController::class,'update'])->name('client.update');

#End Client




