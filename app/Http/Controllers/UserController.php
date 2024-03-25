<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\CostAllocation;
use App\Models\RequestBudget;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function dashboard(Request $request)
{


    $expenses = Expense::all();
    $costAllocations = CostAllocation::all();
    $requestBudgets = RequestBudget::all();

    $recentCostAllocations = CostAllocation::latest()->take(5)->get();
    $recentRequestBudgets = RequestBudget::latest()->take(5)->get();

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

    // Fetch expenses and cost allocations
    $expenses = Expense::all();
    $costAllocations = CostAllocation::all();


        // Use the glob method to fetch all image filenames from the 'public/images' directory
        $imagePaths = glob(public_path('images/*'));

        // Extract only the filenames without the directory path
        $images = array_map('basename', $imagePaths);
        $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();

    return view('user.dashboard', compact('totalNotifications','budgetChartData', 'requestBudgets', 'chartData', 'expenses', 'recentRequestBudgets', 'recentCostAllocations', 'costAllocations', 'images'));
}

public function fetchNews()
{
    // Your News API key
        // News API URL for finance news
        $newsApiUrl = 'https://newsapi.org/v2/everything?q=finance&pageSize=5&apiKey=014d72b0e8ae42aeab34e2163a269a83';

        // Fetch news articles from the News API
        $response = Http::get($newsApiUrl);

        // Extract news articles from the response
        $articles = $response->json()['articles'];

        return view('user.dashboard', compact('articles'));
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
public function fetchExpenseSparkline()
{
    $expenseData = Expense::pluck('amount')->toArray();
    return response()->json($expenseData);
}
public function fetchRequestBudgetSparkline()
    {
        $requestBudgetData = RequestBudget::pluck('amount')->toArray();
        return response()->json($requestBudgetData);
    }
    public function fetchCostAllocationSparkline()
    {
        $costAllocationData = CostAllocation::pluck('amount')->toArray();
        return response()->json($costAllocationData);
    }
    public function show()
    {
        $user = Auth::user();
        return view('users-profile', compact('user'));
    }
    public function faq()
    {
        return view('faqs');
    }

    public function shownotifications()
{
    $expenses = Expense::latest()->take(5)->get();
    $requestBudgets = RequestBudget::latest()->take(5)->get();
    $costAllocations = CostAllocation::latest()->take(5)->get();

    $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();
    $notifications = $expenses->merge($requestBudgets)->merge($costAllocations);

    return view('user.header', compact('notifications', 'totalNotifications','expenses','requestBudgets','costAllocations'));
}



}
