<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostAllocationRule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cost_allocation_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'allocation_method',
    ];

    /**
     * Get the cost allocations associated with the cost allocation rule.
     */
    public function costAllocations(): HasMany
    {
        return $this->hasMany(CostAllocation::class);
    }
}
