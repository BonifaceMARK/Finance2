<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CostAllocation;
use App\models\RequestBudget;
use Carbon\Carbon;
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

        // Fetch total expenses for yesterday from the Expense model
        $totalExpensesYesterday = Expense::whereDate('date', Carbon::yesterday())->sum('amount');

        // Calculate the percentage change in expenses
        $expensesPercentageChange = 0;
        if ($totalExpensesYesterday != 0) {
            $expensesPercentageChange = (($totalExpensesToday - $totalExpensesYesterday) / $totalExpensesYesterday) * 100;
        }


      // Fetch revenue data from the RequestBudget model
    $totalRevenueThisMonth = RequestBudget::whereYear('start_date', now()->year)
    ->whereMonth('start_date', now()->month)
    ->sum('amount');

      // Fetch total cost allocated for this year from the CostAllocation model
      $totalCostAllocatedThisYear = CostAllocation::whereYear('created_at', today()->year)
      ->sum('amount');

  // Fetch total cost allocated for the previous year from the CostAllocation model
  $totalCostAllocatedLastYear = CostAllocation::whereYear('created_at', today()->year - 1)
      ->sum('amount');

  // Calculate the percentage change in cost allocation
  $costAllocationPercentageChange = 0;
  if ($totalCostAllocatedLastYear != 0) {
      $costAllocationPercentageChange = (($totalCostAllocatedThisYear - $totalCostAllocatedLastYear) / $totalCostAllocatedLastYear) * 100;
  }

// Fetch total revenue for the previous month
$totalRevenueLastMonth = RequestBudget::whereYear('start_date', now()->subMonth()->year)
    ->whereMonth('start_date', now()->subMonth()->month)
    ->sum('amount');

// Calculate the percentage change in revenue
$revenuePercentageChange = 0;
if ($totalRevenueLastMonth != 0) {
    $revenuePercentageChange = (($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth) * 100;
}

        // Prepare the data for the chart
        $chartData = $costAllocations->map(function ($allocation) {
            return [
                'name' => $allocation->cost_center,
                'value' => $allocation->amount
            ];
        })->toArray();

        $chartData = [
            'dates' => $requestBudgets->pluck('start_date')->toArray(), // Assuming 'start_date' is used for x-axis
            'prices' => $requestBudgets->pluck('amount')->toArray(), // Assuming 'amount' is used for y-axis
        ];


        return view('user.dashboard', compact('totalCostAllocatedThisYear', 'costAllocationPercentageChange','totalRevenueThisMonth', 'revenuePercentageChange','chartData','expensesPercentageChange','totalExpensesToday', 'expenses', 'recentRequestBudgets','recentCostAllocations','costAllocations'));
    }
}
