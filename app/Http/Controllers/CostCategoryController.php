<?php

namespace App\Http\Controllers;

use App\Models\CostCategory;
use Illuminate\Http\Request;

class CostCategoryController extends Controller
{

    public function index()
    {
        $costCategories = CostCategory::all();
        return view('sub-admin.cost_categories.index', compact('costCategories'));
    }


    public function create()
    {
        return view('sub-admin.cost_categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        CostCategory::create($request->only(['name', 'description']));

        return redirect()->route('cost_categories.index')
            ->with('success', 'Cost category created successfully.');
    }


    public function show(CostCategory $costCategory)
    {
        return view('sub-admin.cost_categories.show', compact('costCategory'));
    }


    public function edit(CostCategory $costCategory)
    {
        return view('sub-admin.cost_categories.edit', compact('costCategory'));
    }


    public function update(Request $request, CostCategory $costCategory)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $costCategory->update($request->only(['name', 'description']));

        return redirect()->route('cost_categories.index')
            ->with('success', 'Cost category updated successfully');
    }


    public function destroy(CostCategory $costCategory)
    {
        $costCategory->delete();

        return redirect()->route('cost_categories.index')
            ->with('success', 'Cost category deleted successfully');
    }
}

