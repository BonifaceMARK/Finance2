<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BudgetCategory;
use App\Models\Report;

class SubAdminController extends Controller
{
    //
    public function dashboard()
    {
        $budgetCategories = BudgetCategory::all();
        $reports = Report::all();
        $categories = $reports->pluck('category');
        $expenses = $reports->pluck('expense');
        $dates = $reports->pluck('date');

        return view('Sub-admin.dashboard', compact('reports','categories', 'expenses', 'dates','budgetCategories'));

    }
}
