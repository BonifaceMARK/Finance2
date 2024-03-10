<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\BudgetPlanController;
use App\Http\Controllers\CostAllocationController;
use App\Http\Controllers\BudgetProposalController;
use App\Http\Controllers\ImageController;


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


Route::get('/expense-categories', [ExpenseCategoryController::class, 'index'])->name('expense-categories.index');
Route::get('/expense-categories/create', [ExpenseCategoryController::class, 'create'])->name('expense-categories.create');
Route::post('/expense-categories', [ExpenseCategoryController::class, 'store'])->name('expense-categories.store');
Route::get('/expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'show'])->name('expense-categories.show');
Route::get('/expense-categories/{expenseCategory}/edit', [ExpenseCategoryController::class, 'edit'])->name('expense-categories.edit');
Route::put('/expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'update'])->name('expense-categories.update');
Route::delete('/expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'destroy'])->name('expense-categories.destroy');

    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

Route::get('/budget', [BudgetCategoryController::class, 'index'])->name('budget.index');
Route::get('/budget/create', [BudgetCategoryController::class, 'create'])->name('budget.create');
Route::post('/budget/store', [BudgetCategoryController::class, 'store'])->name('budget.store');
Route::get('/budget/{budgetCategory}', [BudgetCategoryController::class, 'show'])->name('budget.show');
Route::get('/budget/{budgetCategory}/edit', [BudgetCategoryController::class, 'edit'])->name('budget.edit');
Route::put('/budget/{budgetCategory}', [BudgetCategoryController::class, 'update'])->name('budget.update');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::get('/budget-plans', [BudgetPlanController::class, 'index'])->name('budget-plans.index');
Route::get('/budget-plans/create', [BudgetPlanController::class, 'create'])->name('budget-plans.create');
Route::post('/budget-plans', [BudgetPlanController::class, 'store'])->name('budget-plans.store');
Route::get('/budget-plans/{budgetPlan}', [BudgetPlanController::class, 'show'])->name('budget-plans.show');
Route::get('/budget-plans/{budgetPlan}/edit', [BudgetPlanController::class, 'edit'])->name('budget-plans.edit');
Route::put('/budget-plans/{budgetPlan}', [BudgetPlanController::class, 'update'])->name('budget-plans.update');
Route::delete('/budget-plans/{budgetPlan}', [BudgetPlanController::class, 'destroy'])->name('budget-plans.destroy');

Route::get('/cost_allocations', [CostAllocationController::class, 'index'])->name('cost_allocations.index');
Route::get('/cost_allocations/create', [CostAllocationController::class, 'create'])->name('cost_allocations.create');
Route::post('/cost_allocations', [CostAllocationController::class, 'store'])->name('cost_allocations.store');
Route::get('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'show'])->name('cost_allocations.show');
Route::get('/cost_allocations/{costAllocation}/edit', [CostAllocationController::class, 'edit'])->name('cost_allocations.edit');
Route::put('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'update'])->name('cost_allocations.update');
Route::delete('/cost_allocations/{costAllocation}', [CostAllocationController::class, 'destroy'])->name('cost_allocations.destroy');
});

// ********** Admin Routes *********
Route::group(['prefix' => 'admin','middleware'=>['web','isAdmin']],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('adminDash');

    Route::get('/finance', [AdminController::class, 'financialReport'])->name('FinancialReport');

    Route::get('/budget-proposals', [BudgetProposalController::class, 'index'])->name('budget-proposals.index');
Route::get('/budget-proposals/create', [BudgetProposalController::class, 'create'])->name('budget-proposals.create');
Route::post('/budget-proposals', [BudgetProposalController::class, 'store'])->name('budget-proposals.store');
Route::get('/budget-proposals/{budgetProposal}', [BudgetProposalController::class, 'show'])->name('budget-proposals.show');
Route::get('/budget-proposals/{budgetProposal}/edit', [BudgetProposalController::class, 'edit'])->name('budget-proposals.edit');
Route::put('/budget-proposals/{budgetProposal}', [BudgetProposalController::class, 'update'])->name('budget-proposals.update');
Route::delete('/budget-proposals/{budgetProposal}', [BudgetProposalController::class, 'destroy'])->name('budget-proposals.destroy');

Route::get('/receipt', [ImageController::class, 'index'])->name('images.index');
Route::get('/receipt/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/receipt', [ImageController::class, 'store'])->name('images.store');
Route::delete('/receipt/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

});

// ********** User Routes *********
Route::group(['middleware'=>['web','isUser']],function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
});


