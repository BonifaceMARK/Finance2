<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\RequestBudget;
use App\Models\CostAllocation;

class ForecastController extends Controller
{
    public function forecastIndex()
    {
        $expenses = Expense::all();
        $requestBudgets = RequestBudget::all();
        $costAllocations = CostAllocation::all();
        // Make a GET request to the external API
        $response = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Check if the request was successful
        if ($response->successful()) {
            // Extract the JSON data from the response
            $transactions = $response->json();

            // Prepare data for the chart
            $prices = [];
            $dates = [];
            foreach ($transactions as $transaction) {
                $prices[] = $transaction['transactionAmount'];
                $dates[] = $transaction['transactionDate'];
            }
            $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();
            // Render the view with the chart data
            return view('user.forecast', compact('prices', 'dates','expenses', 'requestBudgets', 'costAllocations','totalNotifications'));
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'Failed to fetch data from the external API'], $response->status());
        }
    }



}
