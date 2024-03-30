<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Expense;
use App\Models\CostAllocation;
use App\Models\RequestBudget;
class ApiController extends Controller
{


    public function fetchChartData()
{
    try {
        // Fetch data from the external API
        $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Check if the request was successful
        if ($response->successful()) {
            // Extract data from the response
            $data = $response->json();

            // Validate the structure of the response data
            if (isset($data['transactions']) && is_array($data['transactions'])) {
                // Extract prices and dates from the fetched data
                $chartData = [
                    'prices' => collect($data['transactions'])->pluck('transactionAmount')->toArray(),
                    'dates' => collect($data['transactions'])->pluck('transactionDate')->toArray(),
                ];

                // Return the chart data
                return $chartData;
            } else {
                // Handle invalid response structure
                Log::error('Invalid response structure: ' . json_encode($data));
                return [];
            }
        } else {
            // Handle unsuccessful response
            Log::error('Error fetching chart data: ' . $response->status());
            return [];
        }
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error fetching chart data: ' . $e->getMessage());

        // Return an empty array
        return [];
    }
}

    public function pushapi()
    {
        $budgets = RequestBudget::all();
        return response()->json($budgets);
    }

    public function fetch()
    {
        // Make a GET request to the external API
        $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Check if the request was successful
        if ($response->successful()) {
            // Extract the JSON data from the response
            $transactions = $response->json();

            // Dump and die the fetched data
            dd($transactions);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'Failed to fetch data from the external API'], $response->status());
        }
    }

    public function fetchAndRenderChart()
{
    // Make a GET request to the external API
    $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

    // Check if the request was successful
    if ($response->successful()) {
        // Extract the JSON data from the response
        $transactions = $response->json();

        // Process the transactions data as needed

        // Prepare data for the chart
        $prices = [];
        $dates = [];
        foreach ($transactions as $transaction) {
            $prices[] = $transaction['transactionAmount'];
            $dates[] = $transaction['transactionDate'];
        }

        // Pass the data to the view
        return view('user.dashboard', compact('prices', 'dates'));
    } else {
        // Handle the case where the request was not successful
        return response()->json(['error' => 'Failed to fetch data from the external API'], $response->status());
    }
}
public function getAllExpenses()
{
    try {
        $expenses = Expense::all();
        if ($expenses->isEmpty()) {
            return response()->json(['message' => 'No expenses found.'], 404);
        }
        return response()->json($expenses);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to fetch expenses.', 'error' => $e->getMessage()], 500);
    }
}
public function getAllCost()
{
    try {
        $costAllocations = CostAllocation::all();
        return response()->json($costAllocations);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch cost allocations.'], 500);
    }
}
public function getAllBudget()
{
    try {
        $requestBudgets = RequestBudget::all();
        return response()->json($requestBudgets);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch request budgets.'], 500);
    }
}
}
