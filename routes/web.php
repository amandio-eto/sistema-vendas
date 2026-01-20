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



Route::post('client',[\App\Http\Controllers\ClientController::class,'create'])->name('client.create');

