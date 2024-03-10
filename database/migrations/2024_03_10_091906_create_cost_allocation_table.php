<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CostAllocation; // Assuming you have a CostAllocation model

class CreateCostAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_allocation', function (Blueprint $table) {
            $table->id();
            $table->string('cost_center');
            $table->string('cost_category');
            $table->string('allocation_method');
            $table->decimal('amount', 10, 2)->default(0); // Assuming 10 digits including 2 decimal places
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Fetch data and pass it to JavaScript
        $costAllocations = CostAllocation::all();
        $chartData = $costAllocations->map(function ($allocation) {
            return [
                'value' => $allocation->amount,
                'name' => $allocation->cost_center
            ];
        })->toArray();

        // Pass $chartData to JavaScript
        echo "<script>var chartData = " . json_encode($chartData) . ";</script>";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_allocation');
    }
}
