<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cost_categories';

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
     * Get the cost entries associated with the cost category.
     */
    public function costEntries(): HasMany
    {
        return $this->hasMany(CostEntry::class);
    }

    /**
     * Get the cost allocations associated with the cost category.
     */
    public function costAllocations(): HasMany
    {
        return $this->hasMany(CostAllocation::class);
    }
}
