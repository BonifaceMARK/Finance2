<?php

namespace App\Http\Controllers;
use App\Models\BudgetPlan;
use App\Models\BudgetProposal;
use App\Models\CostAllocation;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Models\Report;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function financialReport()
    {
        $budgetPlans = BudgetPlan::all();
        $budgetProposals = BudgetProposal::all();
        $expenseCategories = ExpenseCategory::all();
        $expenses = Expense::all();
        $reports = Report::all();
        $costAllocations = CostAllocation::all();
        $images = Image::all();

        return view('admin.financialReport.view', compact('budgetPlans', 'budgetProposals','expenseCategories', 'expenses', 'reports','costAllocations','images'));
    }

}
