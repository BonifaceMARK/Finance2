<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BudgetCategory;
use App\Models\Report;
use App\Models\Expense;
use App\Models\CostAllocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class SubAdminController extends Controller
{
    public function dashboard()
    {
        $budgetCategories = BudgetCategory::all();
        $reports = Report::all();
        $costAllocations = CostAllocation::whereDate('created_at', now()->toDateString())->get();

        $currentMonthExpenses = Expense::whereYear('expense_date', Carbon::now()->year)
            ->whereMonth('expense_date', Carbon::now()->month)
            ->sum('amount');

        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        $previousMonthExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->sum('amount');

        $currentDayExpenses = Expense::whereDate('expense_date', now())->sum('amount');

        $previousDayExpenses = Expense::whereDate('expense_date', now()->subDay())->sum('amount');

        $increasePercentage = $previousDayExpenses != 0 ? ($currentDayExpenses - $previousDayExpenses) / $previousDayExpenses * 100 : 0;

        $currentYearExpenses = Expense::whereYear('expense_date', now()->year)->sum('amount');

        $previousYearExpenses = Expense::whereYear('expense_date', now()->subYear())->sum('amount');

        $decreasePercentage = $previousYearExpenses != 0 ? ($currentYearExpenses - $previousYearExpenses) / $previousYearExpenses * 100 : 0;

        // Fetch image paths
        $imagePaths = File::glob(public_path('images/*'));

        $carouselItems = [];
        if (!empty($imagePaths)) {
            $activeIndex = 0;
            foreach ($imagePaths as $index => $imagePath) {
                // Get the file name without the full path
                $fileName = basename($imagePath);

                $carouselItems[] = [
                    'image' => asset('images/' . $fileName),
                    'active' => $index == $activeIndex ? 'active' : ''
                ];
            }
        }

        return view('Sub-admin.dashboard', compact('reports', 'budgetCategories', 'currentMonthExpenses', 'previousMonthExpenses', 'currentDayExpenses', 'previousDayExpenses', 'increasePercentage', 'currentYearExpenses', 'previousYearExpenses', 'decreasePercentage', 'costAllocations', 'carouselItems'));
    }
}
