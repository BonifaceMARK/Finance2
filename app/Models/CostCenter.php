<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostCenter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cost_centers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the cost entries associated with the cost center.
     */
    public function costEntries(): HasMany
    {
        return $this->hasMany(CostEntry::class);
    }

    /**
     * Get the cost allocations where the cost center is the source.
     */
    public function sourceAllocations(): HasMany
    {
        return $this->hasMany(CostAllocation::class, 'source_cost_center_id');
    }

    /**
     * Get the cost allocations where the cost center is the destination.
     */
    public function destinationAllocations(): HasMany
    {
        return $this->hasMany(CostAllocation::class, 'destination_cost_center_id');
    }
}
