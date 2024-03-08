<?php

namespace App\Http\Controllers;
use App\Models\BudgetPlan;
use App\Models\BudgetProposal;
use App\Models\CostAllocationRule;
use App\Models\CostAllocation;
use App\Models\CostCategory;
use App\Models\CostCenter;
use App\Models\CostEntry;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Models\Report;
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
        $costAllocationRules = CostAllocationRule::all();
        $costAllocations = CostAllocation::all();
        $costCategories = CostCategory::all();
        $costCenters = CostCenter::all();
        $costEntries = CostEntry::all();
        $expenseCategories = ExpenseCategory::all();
        $expenses = Expense::all();
        $reports = Report::all();

        return view('admin.financialReport.view', compact('budgetPlans', 'budgetProposals', 'costAllocationRules', 'costAllocations', 'costCategories', 'costCenters', 'costEntries', 'expenseCategories', 'expenses', 'reports'));
    }
}
