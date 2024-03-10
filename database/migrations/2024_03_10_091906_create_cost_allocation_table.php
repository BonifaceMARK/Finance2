<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
