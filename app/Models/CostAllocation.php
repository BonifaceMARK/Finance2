<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostAllocation extends Model
{
    use HasFactory;

    protected $table = 'cost_allocation';
    protected $fillable = ['item','cost_center', 'cost_category', 'cost_type', 'amount', 'description'];
}
