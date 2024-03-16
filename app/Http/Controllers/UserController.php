<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CostAllocation;
use App\models\RequestBudget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Expense;

class UserController extends Controller
{
    public function dashboard()
{
    $expenses = Expense::all();
    $costAllocations = CostAllocation::all();
    $requestBudgets = RequestBudget::all();

    $recentCostAllocations = CostAllocation::latest()->take(5)->get();
    $recentRequestBudgets = RequestBudget::latest()->take(5)->get();

    $totalExpensesToday = Expense::whereDate('date', today())->sum('amount');
    $totalExpensesYesterday = Expense::whereDate('date', Carbon::yesterday())->sum('amount');
    $expensesPercentageChange = 0;
    if ($totalExpensesYesterday != 0) {
        $expensesPercentageChange = (($totalExpensesToday - $totalExpensesYesterday) / $totalExpensesYesterday) * 100;
    }

    $totalRevenueThisMonth = RequestBudget::whereYear('start_date', now()->year)
        ->whereMonth('start_date', now()->month)
        ->sum('amount');

    $totalCostAllocatedThisYear = CostAllocation::whereYear('created_at', today()->year)
        ->sum('amount');

    $totalCostAllocatedLastYear = CostAllocation::whereYear('created_at', today()->year - 1)
        ->sum('amount');

    $costAllocationPercentageChange = 0;
    if ($totalCostAllocatedLastYear != 0) {
        $costAllocationPercentageChange = (($totalCostAllocatedThisYear - $totalCostAllocatedLastYear) / $totalCostAllocatedLastYear) * 100;
    }

    $totalRevenueLastMonth = RequestBudget::whereYear('start_date', now()->subMonth()->year)
        ->whereMonth('start_date', now()->subMonth()->month)
        ->sum('amount');

    $revenuePercentageChange = 0;
    if ($totalRevenueLastMonth != 0) {
        $revenuePercentageChange = (($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth) * 100;
    }

    $chartData = $costAllocations->map(function ($allocation) {
        return [
            'name' => $allocation->cost_center,
            'value' => $allocation->amount
        ];
    })->toArray();

    // Fetch news and updates related to finance
    $newsResponse = Http::get('https://newsapi.org/v2/everything', [
        'apiKey' => '014d72b0e8ae42aeab34e2163a269a83', // Replace with your actual API key
        'q' => 'finance',
        'pageSize' => 5,
    ]);

    $newsArticles = [];
    if ($newsResponse->successful()) {
        $newsArticles = $newsResponse->json()['articles'];
    }

    $budgetChartData = [
        'dates' => $requestBudgets->pluck('start_date')->toArray(),
        'prices' => $requestBudgets->pluck('amount')->toArray(),
    ];

    return view('user.dashboard', compact('budgetChartData', 'totalCostAllocatedThisYear', 'costAllocationPercentageChange', 'totalRevenueThisMonth', 'revenuePercentageChange', 'chartData', 'expensesPercentageChange', 'totalExpensesToday', 'expenses', 'recentRequestBudgets', 'recentCostAllocations', 'costAllocations', 'newsArticles'));
}

}
