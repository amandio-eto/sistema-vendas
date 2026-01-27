<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
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













#GROUP MIDDLEWARE STAFF
Route::middleware(['auth', 'role:administrator,manager,staff'])
    ->group(function () {
    #1)Dashboard
    Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');
    #EndDashboard
 
    #Report Controller
    Route::get('/transactions/report', [ReportController::class, 'index'])->name('transactions.report');
    Route::get('/transactions/report/pdf', [ReportController::class, 'pdf'])->name('transactions.report.pdf');
    Route::get('/transactions/report/excel', [ReportController::class, 'excel'])->name('transactions.report.excel');
    #End ReportController
    Route::put('/transactions/approve/{id}', [\App\Http\Controllers\TransactionController::class, 'approvededit'])->name('transaction.approvededit');
    Route::put('/transactions/status/{id}', [\App\Http\Controllers\TransactionController::class, 'statusedit'])->name('statusedit');
    Route::get('/transaction/{id}/print', [TransactionController::class, 'printPdf'])->name('transaction.print');


    #1.1 DeliverOrder
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transactions', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.create');
    Route::get('/transactions/{id}/edit', [\App\Http\Controllers\TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'update'])->name('transaction.update');
    #Aproved

    #3) Diver Controllerd
    Route::get('drivers',[\App\Http\Controllers\DriverController::class,'index'])->name('drivers.index');
    Route::post('drivers',[\App\Http\Controllers\DriverController::class,'store'])->name('drivers.store');
    Route::get('drivers/{id}', [\App\Http\Controllers\DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('drivers/{id}', [\App\Http\Controllers\DriverController::class, 'update'])->name('drivers.update');
    #End Driver Controller

    #3) Navegation
    Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
    #End Navegation

    #2Change Password Navegation
    Route::get('/change-password', [AuthController::class, 'profileedit'])->name('password.edit');
    Route::put('/change-password', [AuthController::class, 'profileupdate'])->name('password.update');
    #End Password

    #1)Change Profile Navegation
    Route::get('/profile/photo', [AuthController::class, 'image'])->name('profile.image');
    Route::put('/profile/photo', [AuthController::class, 'updatePhoto'])->name('profile.photo.update');
    #End Profiles

    #ClientController
     Route::get('clients',[\App\Http\Controllers\ClientController::class,'index'])->name('client.index');
    Route::post('clients',[\App\Http\Controllers\ClientController::class,'create'])->name('client.create');
    Route::get('clients/{id}',[\App\Http\Controllers\ClientController::class,'edit'])->name('client.edit');
    Route::put('clients/{id}',[\App\Http\Controllers\ClientController::class,'update'])->name('client.update');
    #End ClientController


       
});
#END MIDDLEWARE SATFF



#GROUP MIDDLEWARE HUSI MANAGER
Route::middleware(['auth', 'role:administrator,manager'])
    ->group(function () {
        #2.2 APROVED
        Route::get('/transactions/approve', [\App\Http\Controllers\TransactionController::class, 'approve'])->name('transaction.approve');
        Route::put('/transactions/status/update/{id}', [\App\Http\Controllers\TransactionController::class, 'approveupdate'])->name('approveupdate');
        #END APRROVED
      
    });

#END GROUP MIDDLEWARE HUSI STAFF



#GROUP MIDDLEWARE HUSI ADMINISTRATOR
Route::middleware(['auth', 'role:administrator'])
    ->group(function () {
    #6) Ida nee AuthController
    Route::get('users',[\App\Http\Controllers\AuthController::class,'users'])->name('users.list');
    Route::post('user',[\App\Http\Controllers\AuthController::class,'store'])->name('user.store');
    Route::delete('user/{id}',[\App\Http\Controllers\AuthController::class,'destroy'])->name('user.destroy');
    Route::get('users/{id}',[\App\Http\Controllers\AuthController::class,'edit'])->name('user.edit');
    Route::put('user/{id}',[\App\Http\Controllers\AuthController::class,'update'])->name('user.update');
    #Logs
    Route::get('user-logs',[\App\Http\Controllers\LogsController::class,'index'])->name('logs.index');
    #EndLogs
    #End AuthController

    #ProductController
    #5) Product Controller
    Route::get('products',[\App\Http\Controllers\ProductController::class,'index'])->name('product.index');
    Route::post('products',[\App\Http\Controllers\ProductController::class,'store'])->name('product.store');
    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    #End Products Controller

    #4) Client
    Route::delete('clients/{id}',[\App\Http\Controllers\ClientController::class,'destroy'])->name('client.destroy');
    #End Client
    #3) DriverController
      Route::delete('/drivers/{id}', [\App\Http\Controllers\DriverController::class, 'destroy'])->name('drivers.destroy');
    #EndCOntroller
    #1) Transcation Destroy 
     Route::delete('/transactions/{id}', [\App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.destroy');
    #EndTrasaction Destroy






    });

#END MIDDLEWARE HUSI ADMINISTRATOR












