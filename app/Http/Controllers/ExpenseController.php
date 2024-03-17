<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DOMDocument;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = Expense::all();
        return view('user.expenses.create', compact('expenses'));
    }


    public function create()
    {
        $expenses = Expense::all();
        return view('user.expenses.create', compact('expenses'));
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
    public function renderExpenseCard(Request $request)
    {
        // Get the SVG data from the request
        $svgData = $request->input('image');

        // Create a DOMDocument object to manipulate the SVG
        $doc = new DOMDocument();
        $doc->loadXML($svgData);

        // Create a unique filename for the image
        $filename = 'expense_card_' . uniqid() . '.svg';

        // Save the SVG content as an image file
        $result = file_put_contents(public_path('images/' . $filename), $doc->saveXML());

        if ($result !== false) {
            // Image saved successfully
            return response()->json(['success' => true, 'filename' => $filename]);
        } else {
            // Failed to save image
            return response()->json(['success' => false, 'message' => 'Failed to save image'], 500);
        }
    }

}
