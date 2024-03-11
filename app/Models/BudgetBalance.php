<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BudgetPlan;

class BudgetBalance extends Model
{
    use HasFactory;

    protected $fillable = ['budget_plan_id', 'remaining_amount'];

    public function budgetPlan()
    {
        return $this->belongsTo(BudgetPlan::class);
    }
}
