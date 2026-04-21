<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ClientSummaryReportController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\loController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RafaController;
use App\Http\Controllers\reinputController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\summaryexelController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\TotalSummaryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Json;

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


Route::middleware(['auth', 'role:administrator,manager,staff'])
    ->group(function (){

  



    Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');
    #Rafa
    Route::get('Rafa-Timor-Leste',[RafaController::class, 'index'])->name('rafa.index');
    #EndRafa
    #Reinput
    Route::get('reinput',[reinputController::class, 'index'])->name('reinput.index');
    Route::post('reinput',[reinputController::class, 'store'])->name('reinput.post');
    #EndReinput

    #CheckListController
    Route::post('/checklist/toggle/{id}', [ChecklistController::class, 'toggle'])
    ->name('checklist.toggle');
    Route::put('/checklist/toggle/{id}', [ChecklistController::class, 'offtoggle'])
    ->name('checklist.toggleoff');
    #EndCheckListController
    
    #Controller TotalSummary 
    Route::get('/total-summary', [TotalSummaryController::class, 'index'])->name('totalsummary.index');
    Route::get('/total-summary/pdf', [TotalSummaryController::class, 'pdf'])->name('totalsummary.pdf');
    Route::get('/total-summary/excel', [TotalSummaryController::class, 'excel'])->name('totalsummary.excel');

    #EndControllerSumarry 

    
    #Summary EXEL 
    

   
    // LIST + FILTER (DATE RANGE)
    Route::get('/summary', [summaryexelController::class, 'index'])
        ->name('summaryexel.index');

    // EXPORT EXCEL (FOLLOW FILTER)
    Route::get('/summary/export/excel', [summaryexelController::class, 'excel'])
        ->name('summary.excel');

    #LO Controller
    
    // Web view
    Route::get('lo/report', [loController::class, 'index'])
        ->name('lo.index');
    // PDF export
    Route::get('lo/pdf', [loController::class, 'pdf'])
        ->name('lo.pdf');
    // Excel export
    Route::get('lo/excel', [loController::class, 'excel'])
        ->name('lo.excel');
    #End LoCOntroller

    #InboxCOntroller
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/create', [InboxController::class, 'create'])->name('inbox.create');
    Route::post('/inbox/store', [InboxController::class, 'store'])->name('inbox.store');
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');
    Route::delete('/inbox/{id}', [InboxController::class, 'destroy'])->name('inbox.destroy');
    // routes/web.php



    #SalesController
    Route::prefix('sale-orders')->group(function () {
    Route::get('/sales', [SaleOrderController::class, 'index'])->name('sale-orders.index');
    Route::post('/store', [SaleOrderController::class, 'store'])->name('sale-orders.store');
    // PDF report
    Route::get('/report/pdf', [SaleOrderController::class, 'pdfReport'])->name('sale-orders.pdf');
    });


    Route::get('/client-summary', [ClientSummaryReportController::class, 'clientSummaryView'])->name('clientSummaryView.index');
    Route::get('/client-summary/pdf', [ClientSummaryReportController::class, 'exportClientSummaryPdf'])
        ->name('reports.client-summary.pdf');
    Route::get('/client-summary/excel', [ClientSummaryReportController::class, 'exportClientSummaryExcel'])
        ->name('reports.client-summary.excel');
 
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



    Route::post('/inbox/mark-read', function () {
    DB::table('inboxes')
        ->where('receiver_id', Auth::id())
        ->where('is_read', 0)
        ->update(['is_read' => 1]);

    return response()->json(['status' => 'ok']);
})->name('inbox.markRead');

});   


#GROUP MIDDLEWARE HUSI MANAGER
Route::middleware(['auth', 'role:administrator,manager'])
    ->group(function () {
        #2.2 APROVED
        Route::get('/transactions/approve', [\App\Http\Controllers\TransactionController::class, 'approve'])->name('transaction.approve');
        Route::put('/transactions/status/update/{id}', [\App\Http\Controllers\TransactionController::class, 'approveupdate'])->name('approveupdate');

      #Tanker
         #Tank Controller 
        Route::prefix('tank')->name('tank.')->group(function () {
        Route::get('/', [TankController::class, 'index'])->name('index');
        Route::get('/create', [TankController::class, 'create'])->name('create');
        Route::post('/', [TankController::class, 'store'])->name('store');

        Route::get('/{id}/edit', [TankController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TankController::class, 'update'])->name('update');
        Route::delete('/{id}', [TankController::class, 'destroy'])->name('destroy');

      
        Route::patch('/{id}/toggle', [TankController::class, 'toggleActive'])->name('toggle');

         Route::get('/{id}/stock', [TankController::class, 'stockcreate'])->name('stock.create');
         Route::post('/{id}/stock', [TankController::class, 'stockstore'])->name('stock.store');
         Route::get('/stock/history', [TankController::class, 'history'])->name('stock.history');
         Route::get('/tank/{id}/stock', [TankController::class, 'stockForm'])->name('tank.stock.create');
     
      
    });
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












