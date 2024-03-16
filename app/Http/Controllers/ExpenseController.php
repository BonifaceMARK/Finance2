<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = Expense::all();
        return view('user.expenses.index', compact('expenses'));
    }


    public function create()
    {
        return view('user.expenses.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')
            ->with('success', 'Expense created successfully.');
    }


    public function show(Expense $expense)
    {
        return view('user.expenses.show', compact('expense'));
    }


    public function edit(Expense $expense)
    {
        return view('user.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
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
    public function fetchExpensesData()
    {
        // Fetch expenses data from the database
        $expenses = Expense::all();

        // Prepare data to pass to the view
        $data = $expenses->map(function ($expense) {
            return [
                'category' => $expense->category,
                'amount' => $expense->amount,
                // Add any additional fields you need
            ];
        });

        // Return the data to the view
        return response()->json($data);
    }


}
