<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['category_id', 'amount', 'expense_date'];

    public function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'category_id');
    }
}
