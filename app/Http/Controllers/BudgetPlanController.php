<?php

namespace App\Http\Controllers;

use App\Models\BudgetPlan;
use Illuminate\Http\Request;

class BudgetPlanController extends Controller
{
    public function index()
    {
        $budgetPlans = BudgetPlan::all();
        return view('sub-admin.budget_plans.index', compact('budgetPlans'));
    }

    public function create()
    {
        return view('sub-admin.budget_plans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        BudgetPlan::create($validatedData);

        return redirect()->route('budget-plans.index')->with('success', 'Budget Plan created successfully.');
    }

    public function show(BudgetPlan $budgetPlan)
    {
        return view('sub-admin.budget_plans.show', compact('budgetPlan'));
    }

    public function edit(BudgetPlan $budgetPlan)
    {
        return view('sub-admin.budget_plans.edit', compact('budgetPlan'));
    }

    public function update(Request $request, BudgetPlan $budgetPlan)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $budgetPlan->update($validatedData);

        return redirect()->route('budget-plans.index')->with('success', 'Budget Plan updated successfully.');
    }

    public function destroy(BudgetPlan $budgetPlan)
    {
        $budgetPlan->delete();

        return redirect()->route('budget-plans.index')->with('success', 'Budget Plan deleted successfully.');
    }
}

