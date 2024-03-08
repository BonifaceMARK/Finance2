<?php

namespace App\Http\Controllers;

use App\Models\CostAllocationRule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CostAllocationRuleController extends Controller
{

    public function index()
    {
        $costAllocationRules = CostAllocationRule::all();
        return view('sub-admin.cost_allocation_rules.index', compact('costAllocationRules'));
    }

    public function show(CostAllocationRule $costAllocationRule)
    {
        return view('sub-admin.cost_allocation_rules.show', compact('costAllocationRule'));
    }


    public function create()
    {
        return view('sub-admin.cost_allocation_rules.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'allocation_method' => 'required|string',
        ]);

        $costAllocationRule = CostAllocationRule::create($validatedData);

        return redirect()->route('costAllocationRules.index')->with('success', 'Cost Allocation Rule created successfully.');
    }


    public function edit(CostAllocationRule $costAllocationRule)
    {
        return view('sub-admin.cost_allocation_rules.edit', compact('costAllocationRule'));
    }


    public function update(Request $request, CostAllocationRule $costAllocationRule)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'allocation_method' => 'required|string',
        ]);

        $costAllocationRule->update($validatedData);

        return redirect()->route('costAllocationRules.index')->with('success', 'Cost Allocation Rule updated successfully.');
    }


    public function destroy(CostAllocationRule $costAllocationRule)
    {
        $costAllocationRule->delete();

        return redirect()->route('costAllocationRules.index')->with('success', 'Cost Allocation Rule deleted successfully.');
    }
}

