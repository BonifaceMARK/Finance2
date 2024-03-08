<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    protected $fillable = ['budget_plan_id', 'title', 'description', 'amount'];

    public function budgetPlan()
    {
        return $this->belongsTo(BudgetPlan::class);
    }
}
