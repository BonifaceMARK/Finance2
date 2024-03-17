<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RequestBudget extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_budgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'amount', 'start_date', 'end_date','status',
    ];

    /**
     * Get the user that owns the request budget.
     */
}
