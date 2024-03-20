<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Phpml\Regression\LeastSquares;
use DOMDocument;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = Expense::all();
        return view('user.expenses.create', compact('expenses'));
    }
    public function fetchExpenseSeasonData()
    {
        // Fetch historical expense data from the Expense model
        $historicalExpenses = Expense::pluck('amount')->toArray();

        // Perform seasonal decomposition and forecasting
        $forecastedData = $this->performSeasonalDecomposition($historicalExpenses, 12);

        // Return the forecasted data as JSON response
        return response()->json($forecastedData);
    }


    // Function to perform Seasonal Decomposition and Forecasting
    protected function performSeasonalDecomposition($data, $futurePeriods)
    {
        // Calculate seasonal component using moving averages
        $seasonalWindowSize = 12; // Assuming a yearly seasonal pattern
        $seasonalData = [];
        for ($i = 0; $i < count($data); $i++) {
            $total = 0;
            for ($j = $i - $seasonalWindowSize; $j <= $i + $seasonalWindowSize; $j++) {
                if ($j >= 0 && $j < count($data)) {
                    $total += $data[$j];
                }
            }
            $seasonalData[$i] = $total / (2 * $seasonalWindowSize + 1);
        }

        // Calculate trend component using centered moving averages
        $trendData = [];
        for ($i = $seasonalWindowSize; $i < count($data) - $seasonalWindowSize; $i++) {
            $total = 0;
            for ($j = $i - $seasonalWindowSize; $j <= $i + $seasonalWindowSize; $j++) {
                $total += $data[$j];
            }
            $trendData[$i] = $total / (2 * $seasonalWindowSize + 1);
        }

        // Calculate residual component
        $residualData = array_map(function ($value, $index) use ($data, $seasonalData, $trendData) {
            return $data[$index] - $seasonalData[$index] - $trendData[$index];
        }, $data, array_keys($data));

        // Perform forecasting for future periods
        $forecastedData = [];
        for ($i = 0; $i < $futurePeriods; $i++) {
            $lastValue = end($data);
            $nextValue = $lastValue + end($trendData) + $seasonalData[count($data) - 12 + $i % 12]; // Assuming repeating seasonal pattern
            $forecastedData[] = $nextValue;
            $data[] = $nextValue;
            $trendData[] = end($trendData) + $nextValue;
        }

        // Return the forecasted data
        return $forecastedData;
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
    public function fetchExpenseChartWithMovingAverage()
    {
        // Fetch expense data from the Expense model
        $expenses = Expense::all();

        // Prepare data for the line chart
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']; // Assuming these are the categories
        $data = [];

        // Initialize data array with 0 values for each category
        foreach ($categories as $category) {
            $data[$category] = 0;
        }

        // Loop through expenses and sum the amounts for each category
        foreach ($expenses as $expense) {
            $month = date('M', strtotime($expense->date));
            $data[$month] += $expense->amount;
        }

        // Convert data to an array of values
        $chartData = array_values($data);

        // Calculate moving averages (adjust window size as needed)
        $movingAverages = $this->calculateMovingAverages($chartData, 3);

        // Extend data with moving average values
        $extendedData = array_merge($chartData, $movingAverages);

        return response()->json($extendedData);
    }

    protected function calculateMovingAverages($data, $windowSize)
    {
        $movingAverages = [];
        for ($i = 0; $i < count($data) - $windowSize + 1; $i++) {
            $sum = 0;
            for ($j = $i; $j < $i + $windowSize; $j++) {
                $sum += $data[$j];
            }
            $movingAverages[] = $sum / $windowSize;
        }
        return $movingAverages;
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
