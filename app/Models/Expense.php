<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BudgetBalance;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'amount', 'expense_date'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($expense) {
            // Deduct the expense amount from the budget balance
            $budgetBalance = BudgetBalance::where('budget_plan_id', $expense->category->budget_plan_id)->first();
            $budgetBalance->remaining_amount -= $expense->amount;
            $budgetBalance->save();
        });
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
