<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\models\RequestBudget;

use Illuminate\Support\Facades\Crypt;
class RequestBudgetController extends Controller
{

    public function index()
    {
        // Fetch all request budgets
        $requestBudgets = RequestBudget::all();

        // Return view with request budgets data
        return view('user.request_budgets.create', compact('requestBudgets'));
    }


    public function create()
    {
        // Calculate total revenue for last month
        $totalRevenueLastMonth = RequestBudget::whereYear('start_date', now()->subMonth()->year)
            ->whereMonth('start_date', now()->subMonth()->month)
            ->sum('amount');

        // Calculate total revenue for this month
        $totalRevenueThisMonth = RequestBudget::whereYear('start_date', now()->year)
            ->whereMonth('start_date', now()->month)
            ->sum('amount');

        // Calculate revenue percentage change
        $revenuePercentageChange = 0;
        if ($totalRevenueLastMonth != 0) {
            $revenuePercentageChange = (($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth) * 100;
        }

        // Fetch all request budgets
        $requestBudgets = RequestBudget::all();

        // Return view with request budgets data
        return view('user.request_budgets.create', compact('totalRevenueLastMonth', 'totalRevenueThisMonth', 'revenuePercentageChange', 'requestBudgets'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Set a default value for the status field
        $request->merge(['status' => 'pending']);
        RequestBudget::create($request->all());
        return redirect()->route('request_budgets.create')
            ->with('success', 'Request budget created successfully.');
    }


    public function show($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Return view with request budget data
        return view('user.request_budgets.show', compact('requestBudget'));
    }


    public function edit($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Return the edit form view with request budget data
        return view('user.request_budgets.edit', compact('requestBudget'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Update the request budget
        $requestBudget->update($request->all());

        // Redirect to the index page with success message
        return redirect()->route('request_budgets.index')
            ->with('success', 'Request budget updated successfully.');
    }


    public function destroy($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Delete the request budget
        $requestBudget->delete();

        // Redirect to the index page with success message
        return redirect()->route('request_budgets.index')
            ->with('success', 'Request budget deleted successfully.');
    }
    public function budgetTrends()
    {
        // Fetch data from the RequestBudget model
        $requestBudgets = RequestBudget::all();

        // Format data for the chart
        $budgetChartData = [
            'dates' => $requestBudgets->pluck('start_date')->toArray(),
            'prices' => $requestBudgets->pluck('amount')->toArray(),
        ];

        return view('user.dashboard', compact('budgetChartData'));
    }

    public function pushapi()
    {
        $budget = RequestBudget::all();
        return view('api.budget-s-app', ['budget' => $budget]);
    }
}
