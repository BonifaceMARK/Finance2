<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CostAllocationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\RequestBudgetController;

use SebastianBergmann\CodeCoverage\Report\Xml\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/finance/terms', [FinanceController::class, 'showTerms'])->name('finance.terms');

Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/loginload',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout']);

// ********** Super Admin Routes *********
Route::group(['prefix' => 'super-admin','middleware'=>['web','isSuperAdmin']],function(){
    Route::get('/dashboard',[SuperAdminController::class,'dashboard']);

    Route::get('/users',[SuperAdminController::class,'users'])->name('superAdminUsers');
    Route::get('/manage-role',[SuperAdminController::class,'manageRole'])->name('manageRole');
    Route::post('/update-role',[SuperAdminController::class,'updateRole'])->name('updateRole');
});

// ********** Sub Admin Routes *********
Route::group(['prefix' => 'sub-admin','middleware'=>['web','isSubAdmin']],function(){
    Route::get('/dashboard',[SubAdminController::class,'dashboard'])->name('display');





});

// ********** Admin Routes *********
Route::group(['prefix' => 'admin','middleware'=>['web','isAdmin']],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('adminDash');

    Route::get('/finance', [AdminController::class, 'financialReport'])->name('FinancialReport');


Route::get('/receipt', [ImageController::class, 'index'])->name('images.index');
Route::get('/receipt/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/receipt', [ImageController::class, 'store'])->name('images.store');
Route::delete('/receipt/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

});

// ********** User Routes *********
Route::group(['middleware'=>['web','isUser']],function(){
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('forecast');

    Route::get('/expenses-data', [ExpenseController::class, 'fetchExpensesData']);
    Route::get('/cost-allocations-data', [ExpenseController::class, 'getCostAllocationsData']);

    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

Route::get('/cost_allocations', [CostAllocationController::class, 'index'])->name('cost_allocations.index');
Route::get('/cost_allocations/create', [CostAllocationController::class, 'create'])->name('cost_allocations.create');
Route::post('/cost_allocations', [CostAllocationController::class, 'store'])->name('cost_allocations.store');
Route::get('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'show'])->name('cost_allocations.show');
Route::get('/cost_allocations/{costAllocation}/edit', [CostAllocationController::class, 'edit'])->name('cost_allocations.edit');
Route::put('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'update'])->name('cost_allocations.update');
Route::delete('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'destroy'])->name('cost_allocations.destroy');

Route::get('/request_budgets', [RequestBudgetController::class, 'index'])->name('request_budgets.index');
Route::get('/request_budgets/create', [RequestBudgetController::class, 'create'])->name('request_budgets.create');
Route::post('/request_budgets', [RequestBudgetController::class, 'store'])->name('request_budgets.store');
Route::get('/request_budgets/{id}', [RequestBudgetController::class, 'show'])->name('request_budgets.show');
Route::get('/request_budgets/{id}/edit', [RequestBudgetController::class, 'edit'])->name('request_budgets.edit');
Route::put('/request_budgets/{id}', [RequestBudgetController::class, 'update'])->name('request_budgets.update');
Route::delete('/request_budgets/{id}', [RequestBudgetController::class, 'destroy'])->name('request_budgets.destroy');
});


