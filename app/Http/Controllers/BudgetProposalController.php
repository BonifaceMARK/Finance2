<?php

namespace App\Http\Controllers;

use App\Models\BudgetPlan;
use App\Models\BudgetProposal;
use Illuminate\Http\Request;



class BudgetProposalController extends Controller
{
    public function index()
    {
        $budgetProposals = BudgetProposal::all();
        return view('admin.budget_proposals.index', compact('budgetProposals'));
    }

    public function create()
    {

        $budgetPlans = BudgetPlan::all();
        return view('admin.budget_proposals.create', compact('budgetPlans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'budget_plan_id' => 'required|exists:budget_plans,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        BudgetProposal::create($validatedData);

        return redirect()->route('budget-proposals.index')->with('success', 'Budget Proposal created successfully.');
    }

    public function show(BudgetProposal $budgetProposal)
    {
        return view('budget_proposals.show', compact('budgetProposal'));
    }

    public function edit(BudgetProposal $budgetProposal)
    {
        $budgetPlans = BudgetPlan::all();
        return view('admin.budget_proposals.edit', compact('budgetProposal', 'budgetPlans'));
    }

    public function update(Request $request, BudgetProposal $budgetProposal)
    {
        $validatedData = $request->validate([
            'budget_plan_id' => 'required|exists:budget_plans,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $budgetProposal->update($validatedData);

        return redirect()->route('budget-proposals.index')->with('success', 'Budget Proposal updated successfully.');
    }

    public function destroy(BudgetProposal $budgetProposal)
    {
        $budgetProposal->delete();

        return redirect()->route('budget-proposals.index')->with('success', 'Budget Proposal deleted successfully.');
    }
}

