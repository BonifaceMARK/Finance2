<?php

namespace App\Http\Controllers;

use App\Models\CostEntry;
use App\Models\CostCenter;
use App\Models\CostCategory;
use Illuminate\Http\Request;

class CostEntryController extends Controller
{

    public function index()
    {
        $costEntries = CostEntry::all();
        return view('sub-admin.cost_entries.index', compact('costEntries'));
    }


    public function create()
    {
        $costCategories = CostCategory::all();
        $costCenters = CostCenter::all();
        return view('sub-admin.cost_entries.create', compact('costCenters','costCategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'cost_center_id' => 'required',
            'cost_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        CostEntry::create($request->all());

        return redirect()->route('cost_entries.index')
                         ->with('success','Cost entry created successfully.');
    }

    public function show(CostEntry $costEntry)
    {
        return view('sub-admin.cost_entries.show', compact('costEntry'));
    }


    public function edit(CostEntry $costEntry)
    {
        // Add logic to fetch cost centers and cost categories if needed
        return view('sub-admin.cost_entries.edit', compact('costEntry'));
    }


    public function update(Request $request, CostEntry $costEntry)
    {
        $request->validate([
            'cost_center_id' => 'required',
            'cost_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        $costEntry->update($request->all());

        return redirect()->route('cost_entries.index')
                         ->with('success','Cost entry updated successfully');
    }


    public function destroy(CostEntry $costEntry)
    {
        $costEntry->delete();

        return redirect()->route('cost_entries.index')
                         ->with('success','Cost entry deleted successfully');
    }
}
