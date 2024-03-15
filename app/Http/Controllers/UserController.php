<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CostAllocation;
use App\models\RequestBudget;
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


        return view('user.dashboard', compact('chartData', 'expenses', 'recentRequestBudgets','recentCostAllocations'));
    }
}
