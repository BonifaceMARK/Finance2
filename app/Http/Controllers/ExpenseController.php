<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::all();
        $expenses = Expense::all();
        return view('sub-admin.expenses.index', compact('expenses','categories'));
    }

    public function create()
    {
        $categories = ExpenseCategory::all();
        return view('sub-admin.expenses.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('sub-admin.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('sub-admin.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense updated successfully');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense deleted successfully');
    }
}
