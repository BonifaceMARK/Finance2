<?php

namespace App\Http\Controllers;

use App\Models\CostAllocation;
use Illuminate\Http\Request;


class CostAllocationController extends Controller
{

    public function index()
    {
        $costAllocations = CostAllocation::all();
        return view('user.cost_allocations.create', compact('costAllocations'));
    }

    public function create()
    {
        // Fetch all cost allocations
        $costAllocations = CostAllocation::all();
        $totalCostAllocatedThisYear = CostAllocation::whereYear('created_at', today()->year)
        ->sum('amount');

    $totalCostAllocatedLastYear = CostAllocation::whereYear('created_at', today()->year - 1)
        ->sum('amount');

    $costAllocationPercentageChange = 0;
    if ($totalCostAllocatedLastYear != 0) {
        $costAllocationPercentageChange = (($totalCostAllocatedThisYear - $totalCostAllocatedLastYear) / $totalCostAllocatedLastYear) * 100;
    }

        // Pass both variables to the view
        return view('user.cost_allocations.create', compact('totalCostAllocatedThisYear', 'costAllocationPercentageChange','costAllocations'));
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

