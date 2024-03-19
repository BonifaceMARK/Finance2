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

        $totalExpensesToday = Expense::whereDate('date', today())->sum('amount');
        $totalExpensesYesterday = Expense::whereDate('date', Carbon::yesterday())->sum('amount');
        $expensesPercentageChange = 0;
        if ($totalExpensesYesterday != 0) {
            $expensesPercentageChange = (($totalExpensesToday - $totalExpensesYesterday) / $totalExpensesYesterday) * 100;
        }
        $totalExpensesThisMonth = Expense::whereYear('date', today()->year)
        ->whereMonth('date', today()->month)
        ->sum('amount');

        return view('user.expenses.create', compact('expensesPercentageChange','totalExpensesToday','totalExpensesThisMonth','expenses'));
    }
    public function fetchExpenseCategory()
    {
        $expenses = Expense::all();

        // Debugging: Output the fetched expenses to check if data is correct
        // dd($expenses);

        // Process expenses data to prepare it for the chart
        $categories = $expenses->pluck('category')->unique()->values();
        $series = [];

        foreach ($categories as $category) {
            $totalAmount = $expenses->where('category', $category)->sum('amount');
            $series[] = $totalAmount;
        }

        // Debugging: Output the processed data to check if it's correct
        // dd([
        //     'series' => $series,
        //     'labels' => $categories->toArray()
        // ]);

        return response()->json([
            'series' => $series,
            'labels' => $categories->toArray()
        ]);
    }
    public function fetchExpenseChartData()
    {
        // Fetch expense data from the Expense model
        $expenses = Expense::all();

        // Prepare data for the line chart
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
        $data = [];

        // Initialize data array with 0 values for each category
        foreach ($categories as $category) {
            $data[$category] = 0;
        }

        // Loop through expenses and sum the amounts for each month
        foreach ($expenses as $expense) {
            $month = date('M', strtotime($expense->date));
            $data[$month] += $expense->amount;
        }

        // Convert data to an array of values
        $chartData = array_values($data);

        return response()->json($chartData);
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

        return redirect()->route('expenses.create')
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
