<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostAllocation extends Model
{
    use HasFactory;

    protected $table = 'cost_allocation';
    protected $fillable = ['cost_center', 'cost_category', 'allocation_method', 'amount', 'description'];
}
