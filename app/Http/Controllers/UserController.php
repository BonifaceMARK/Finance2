<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\CostAllocation;
use App\Models\RequestBudget;

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

    $budgetChartData = [
        'dates' => $requestBudgets->pluck('start_date')->toArray(),
        'prices' => $requestBudgets->pluck('amount')->toArray(),
    ];

    return view('user.dashboard', compact('budgetChartData', 'totalCostAllocatedThisYear', 'costAllocationPercentageChange', 'totalRevenueThisMonth', 'revenuePercentageChange', 'chartData', 'expensesPercentageChange', 'totalExpensesToday', 'expenses', 'recentRequestBudgets', 'recentCostAllocations', 'costAllocations'));
}

public function fetchNews()
{
    // Your News API key
    $apiKey = '014d72b0e8ae42aeab34e2163a269a83';

    // News API URL for finance news
    $newsApiUrl = 'https://newsapi.org/v2/everything?q=finance&pageSize=5&apiKey=' . $apiKey;

    // Fetch news articles from the News API
    $newsResponse = Http::get($newsApiUrl);

    $newsArticles = [];

    if ($newsResponse->successful()) {
        $newsArticles = $newsResponse->json()['articles'];
    }

    // Pass the fetched news articles to the Blade view
    return view('user.dashboard', compact('newsArticles'));
}
public function fetchExpensesData()
{
    $expenses = Expense::select('category', 'amount')->whereDate('created_at', now())->get();
    $costAllocations = CostAllocation::select('cost_category', 'amount')->whereDate('created_at', now())->get();
    $requestBudgets = RequestBudget::select('title', 'amount')->whereDate('created_at', now())->get();

    $data = [
        'expenses' => $expenses,
        'costAllocations' => $costAllocations,
        'requestBudgets' => $requestBudgets,
    ];

    return response()->json($data);
}

}
