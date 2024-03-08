<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostAllocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cost_allocations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_cost_center_id',
        'destination_cost_center_id',
        'cost_category_id',
        'amount',
        'date',
    ];

    /**
     * Get the source cost center for the cost allocation.
     */
    public function sourceCostCenter(): BelongsTo
    {
        return $this->belongsTo(CostCenter::class, 'source_cost_center_id');
    }

    /**
     * Get the destination cost center for the cost allocation.
     */
    public function destinationCostCenter(): BelongsTo
    {
        return $this->belongsTo(CostCenter::class, 'destination_cost_center_id');
    }

    /**
     * Get the cost category associated with the cost allocation.
     */
    public function costCategory(): BelongsTo
    {
        return $this->belongsTo(CostCategory::class);
    }
}
