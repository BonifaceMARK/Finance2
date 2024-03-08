<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use App\Models\CostCategory;
use App\Models\CostAllocationRule;
use App\Models\CostEntry;
use App\Models\CostAllocation;
use Illuminate\Http\Request;

class CostManagementController extends Controller
{
    public function index()
    {
        $costCenters = CostCenter::all();
        $costCategories = CostCategory::all();
        $costAllocationRules = CostAllocationRule::all();
        $costEntries = CostEntry::all();
        $costAllocations = CostAllocation::all();

        return view('Sub-admin.cost_management.index', compact('costCenters', 'costCategories', 'costAllocationRules', 'costEntries', 'costAllocations'));
    }

    public function create()
    {
        $costCenters = CostCenter::all();
        $costCategories = CostCategory::all();
        return view('Sub-admin.cost_management.create', compact('costCenters', 'costCategories'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'cost_centers.*.name' => 'required|string|max:255',
        'cost_centers.*.description' => 'nullable|string',
        'cost_categories.*.name' => 'required|string|max:255',
        'cost_categories.*.description' => 'nullable|string',
        'cost_allocation_rules.*.name' => 'required|string|max:255',
        'cost_allocation_rules.*.description' => 'nullable|string',
        'cost_allocation_rules.*.allocation_method' => 'required|string|in:percentage,activity_based',
        'cost_entries.*.cost_center_id' => 'required|exists:cost_centers,id',
        'cost_entries.*.cost_category_id' => 'required|exists:cost_categories,id',
        'cost_entries.*.amount' => 'required|numeric',
        'cost_entries.*.date' => 'required|date',
        'cost_allocations.*.source_cost_center_id' => 'required|exists:cost_centers,id',
        'cost_allocations.*.destination_cost_center_id' => 'required|exists:cost_centers,id',
        'cost_allocations.*.cost_category_id' => 'required|exists:cost_categories,id',
        'cost_allocations.*.amount' => 'required|numeric',
        'cost_allocations.*.date' => 'required|date',
    ]);


    // Create Cost Centers
    if (!empty($request->cost_centers)) {
        foreach ($request->cost_centers as $costCenterData) {
            CostCenter::create([
                'name' => $costCenterData['name'],
                'description' => $costCenterData['description'],
            ]);
        }
    }

    // Create Cost Categories
    if (!empty($request->cost_categories)) {
        foreach ($request->cost_categories as $costCategoryData) {
            CostCategory::create([
                'name' => $costCategoryData['name'],
                'description' => $costCategoryData['description'],
            ]);
        }
    }

    // Create Cost Allocation Rules
    if (!empty($request->cost_allocation_rules)) {
        foreach ($request->cost_allocation_rules as $costAllocationRuleData) {
            CostAllocationRule::create([
                'name' => $costAllocationRuleData['name'],
                'description' => $costAllocationRuleData['description'],
                'allocation_method' => $costAllocationRuleData['allocation_method'],
            ]);
        }
    }

    // Create Cost Entries
    if (!empty($request->cost_entries)) {
        foreach ($request->cost_entries as $costEntryData) {
            CostEntry::create([
                'cost_center_id' => $costEntryData['cost_center_id'],
                'cost_category_id' => $costEntryData['cost_category_id'],
                'amount' => $costEntryData['amount'],
                'date' => $costEntryData['date'],
            ]);
        }
    }

    // Create Cost Allocations
    if (!empty($request->cost_allocations)) {
        foreach ($request->cost_allocations as $costAllocationData) {
            CostAllocation::create([
                'source_cost_center_id' => $costAllocationData['source_cost_center_id'],
                'destination_cost_center_id' => $costAllocationData['destination_cost_center_id'],
                'cost_category_id' => $costAllocationData['cost_category_id'],
                'amount' => $costAllocationData['amount'],
                'date' => $costAllocationData['date'],
            ]);
        }
    }

    return redirect()->route('cost_management.index')->with('success', 'Entries created successfully.');
}


    public function show()
    {
        $costCenters = CostCenter::all();
        $costCategories = CostCategory::all();
        $costAllocationRules = CostAllocationRule::all();
        $costEntries = CostEntry::all();
        $costAllocations = CostAllocation::all();

        return view('Sub-admin.cost_management.show', compact('costCenters', 'costCategories', 'costAllocationRules', 'costEntries', 'costAllocations'));
    }

    public function edit()
    {
        $costCenters = CostCenter::all();
        $costCategories = CostCategory::all();
        $costAllocationRules = CostAllocationRule::all();
        $costEntries = CostEntry::all();
        $costAllocations = CostAllocation::all();

        return view('Sub-admin.cost_management.edit', compact('costCenters', 'costCategories', 'costAllocationRules', 'costEntries', 'costAllocations'));
    }

    public function update(Request $request)
    {
        CostCenter::whereIn('id', $request->cost_centers)->update($request->only('name', 'description'));
        CostCategory::whereIn('id', $request->cost_categories)->update($request->only('name', 'description'));
        CostAllocationRule::whereIn('id', $request->cost_allocation_rules)->update($request->only('name', 'description', 'allocation_method'));
        CostEntry::whereIn('id', $request->cost_entries)->update($request->only('cost_center_id', 'cost_category_id', 'amount', 'date'));
        CostAllocation::whereIn('id', $request->cost_allocations)->update($request->only('source_cost_center_id', 'destination_cost_center_id', 'cost_category_id', 'amount', 'date'));

        return redirect()->route('cost_management.edit')->with('success', 'All entries updated successfully.');
    }

    public function destroy(Request $request)
    {
        CostCenter::destroy($request->cost_centers);
        CostCategory::destroy($request->cost_categories);
        CostAllocationRule::destroy($request->cost_allocation_rules);
        CostEntry::destroy($request->cost_entries);
        CostAllocation::destroy($request->cost_allocations);

        return redirect()->route('cost_management.edit')->with('success', 'Selected entries deleted successfully.');
    }
}
