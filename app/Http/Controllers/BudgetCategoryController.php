<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\BudgetCategory;

class BudgetCategoryController extends Controller
{

    public function display()
    {
        $budgetCategories = BudgetCategory::all();
        return view('Sub-admin.dashboard', compact('budgetCategories'));
    }
    public function index()
    {
        $budgetCategories = BudgetCategory::all();
        return view('Sub-admin.budget.index', compact('budgetCategories'));
    }


    public function create()
    {
        return view('Sub-admin.budget.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'allocated_budget' => 'required|numeric',
            'actual_spending' => 'required|numeric',
        ]);

        BudgetCategory::create($request->all());

        return redirect()->route('budget.index')
            ->with('success', 'Budget category created successfully.');
    }


    public function show(BudgetCategory $budgetCategory)
    {
        return view('Sub-admin.budget.show', compact('budgetCategory'));
    }


public function edit(BudgetCategory $budgetCategory)
{
    return view('Sub-admin.budget.edit', compact('budgetCategory'));
}


public function update(Request $request, BudgetCategory $budgetCategory)
{
    $request->validate([
        'name' => 'required',
        'allocated_budget' => 'required|numeric',
        'actual_spending' => 'required|numeric',
    ]);

    $budgetCategory->update($request->all());

    return redirect()->route('budget.index')
        ->with('success', 'Budget category updated successfully.');
}

}
