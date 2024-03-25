<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Expense;
use App\Models\RequestBudget;
use App\Models\CostAllocation;
use Illuminate\Support\Facades\DB;


class CostAllocationController extends Controller
{

    public function index()
    {
        $costAllocations = CostAllocation::all();
        return view('user.cost_allocations.create', compact('costAllocations'));
    }

    public function create()
    {
        $expenses = Expense::all();
        $requestBudgets = RequestBudget::all();
        $costAllocations = CostAllocation::all();
        $totalCostAllocatedThisYear = CostAllocation::whereYear('created_at', today()->year)
        ->sum('amount');

    $totalCostAllocatedLastYear = CostAllocation::whereYear('created_at', today()->year - 1)
        ->sum('amount');

    $costAllocationPercentageChange = 0;
    if ($totalCostAllocatedLastYear != 0) {
        $costAllocationPercentageChange = (($totalCostAllocatedThisYear - $totalCostAllocatedLastYear) / $totalCostAllocatedLastYear) * 100;
    }
    $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();
        // Pass both variables to the view
        return view('user.cost_allocations.create', compact('totalNotifications','totalCostAllocatedThisYear','expenses', 'requestBudgets','costAllocationPercentageChange','costAllocations'));
    }

    public function fetchExpenseCostAllocationData()
    {
        try {
            // Fetch expense data
            $expenseCategories = Expense::select('category', DB::raw('SUM(amount) as amount'))
                ->groupBy('category')
                ->get()
                ->toArray();

            // Fetch cost allocation data
            $costAllocationCategories = CostAllocation::select('cost_category as category', DB::raw('SUM(amount) as amount'))
                ->groupBy('cost_category')
                ->get()
                ->toArray();

            return response()->json([
                'expenseCategories' => $expenseCategories,
                'costAllocationCategories' => $costAllocationCategories
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching expense and cost allocation data: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cost_center' => 'required|string',
            'cost_category' => 'required|string',
            'allocation_method' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        CostAllocation::create($validatedData);

        return redirect()->route('cost_allocations.create')->with('success', 'Cost Allocation created successfully.');
    }


    public function show(CostAllocation $costAllocation)
    {
        return view('user.cost_allocations.show', compact('costAllocation'));
    }

    public function edit(CostAllocation $costAllocation)
    {
        return view('user.cost_allocations.edit', compact('costAllocation'));
    }

    public function update(Request $request, CostAllocation $costAllocation)
    {
        $validatedData = $request->validate([
            'cost_center' => 'required|string',
            'cost_category' => 'required|string',
            'allocation_method' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $costAllocation->update($validatedData);

        return redirect()->route('cost_allocations.index')->with('success', 'Cost Allocation updated successfully.');
    }


    public function destroy(CostAllocation $costAllocation)
    {
        $costAllocation->delete();

        return redirect()->route('cost_allocations.index')->with('success', 'Cost Allocation deleted successfully.');
    }

}

