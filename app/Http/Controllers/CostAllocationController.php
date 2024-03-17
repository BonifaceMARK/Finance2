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

        // Use the glob method to fetch all image filenames from the 'public/images' directory
        $imagePaths = glob(public_path('images/*'));

        // Extract only the filenames without the directory path
        $images = array_map('basename', $imagePaths);

        // Pass both variables to the view
        return view('user.cost_allocations.create', compact('costAllocations', 'images'));
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

