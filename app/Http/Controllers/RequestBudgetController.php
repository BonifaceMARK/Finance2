<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\RequestBudget;
use App\Models\CostAllocation;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Crypt;
class RequestBudgetController extends Controller
{

    public function index()
    {


        $requestBudgets = RequestBudget::all();

        // Return view with request budgets data
        return view('user.request_budgets.create', compact('requestBudgets'));
    }


    public function create()
    {
        $curl = curl_init();
$url = "https://fms3-swasfcrb.fguardians-fms.com/s-pull-approved";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
if (!empty($data)) {
    foreach ($data as $item) {
        // Retrieve the record by its reference
        $existingItem = RequestBudget::where('reference', $item['reference'])->first();
        if ($existingItem) {

            $nestedComment = $item['comment'];
            $comment = $nestedComment['comment'];
            $existingItem->status = $item['status'];
            $existingItem->updated_at = $item['updated_at'];
            $existingItem->comment = $comment;
            // Save the changes
            $existingItem->save();
        } else {
            // If the record does not exist, create a new record

        }

    }
}
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
        $expenses = Expense::all();
        $requestBudgets = RequestBudget::all();
        $costAllocations = CostAllocation::all();
        $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();
        // Return view with request budgets data
        return view('user.request_budgets.create', compact('expenses','costAllocations','totalNotifications','totalRevenueLastMonth', 'totalRevenueThisMonth', 'revenuePercentageChange', 'requestBudgets'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric|max:9999999.99',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $randomString = Helpers::generateRandomString(10);
        // Set a default value for the status field
        $request->merge(['status' => 'pending']);
        $request->merge(['department' => 'RequestBudget']);
        $request->merge(['name' => auth()->user()->name]);
        $request->merge(['reference' => $randomString]);
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
