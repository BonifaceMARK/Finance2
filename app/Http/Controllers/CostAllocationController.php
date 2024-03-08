<?php

namespace App\Http\Controllers;

use App\Models\CostAllocation;
use App\Models\CostCenter;
use App\Models\CostCategory;
use Illuminate\Http\Request;

class CostAllocationController extends Controller
{

    public function index()
    {
        $costAllocations = CostAllocation::all();
        return view('sub-admin.cost_allocations.index', compact('costAllocations'));
    }


    public function create()
    {
        $costCenters = CostCenter::all();
        $costCategories = CostCategory::all();
        return view('sub-admin.cost_allocations.create', compact('costCenters','costCategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'source_cost_center_id' => 'required',
            'destination_cost_center_id' => 'required',
            'cost_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        CostAllocation::create($request->all());

        return redirect()->route('cost_allocations.index')
                         ->with('success','Cost allocation created successfully.');
    }


    public function show(CostAllocation $costAllocation)
    {
        return view('sub-admin.cost_allocations.show', compact('costAllocation'));
    }


    public function edit(CostAllocation $costAllocation)
    {
        // Add logic to fetch cost centers and cost categories if needed
        return view('sub-admin.cost_allocations.edit', compact('costAllocation'));
    }


    public function update(Request $request, CostAllocation $costAllocation)
    {
        $request->validate([
            'source_cost_center_id' => 'required',
            'destination_cost_center_id' => 'required',
            'cost_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        $costAllocation->update($request->all());

        return redirect()->route('cost_allocations.index')
                         ->with('success','Cost allocation updated successfully');
    }


    public function destroy(CostAllocation $costAllocation)
    {
        $costAllocation->delete();

        return redirect()->route('cost_allocations.index')
                         ->with('success','Cost allocation deleted successfully');
    }
}
