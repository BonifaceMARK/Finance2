<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetPlan extends Model
{
    protected $fillable = ['title', 'description', 'total_amount', 'start_date', 'end_date'];

    public function budgetProposals(): HasMany
    {
        return $this->hasMany(BudgetProposal::class);
    }
}

