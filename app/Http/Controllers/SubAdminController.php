<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BudgetCategory;
use App\Models\Report;
use App\Models\Expense;
use Carbon\Carbon;
class SubAdminController extends Controller
{
    //
    public function dashboard()
    {
        $budgetCategories = BudgetCategory::all();
        $reports = Report::all();

        $currentMonthExpenses = Expense::whereYear('expense_date', Carbon::now()->year)
            ->whereMonth('expense_date', Carbon::now()->month)
            ->sum('amount');

        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        $previousMonthExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->sum('amount');

        return view('Sub-admin.dashboard', compact('reports', 'budgetCategories', 'currentMonthExpenses', 'previousMonthExpenses'));
    }

}
