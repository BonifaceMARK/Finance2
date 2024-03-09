<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_allocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_cost_center_id');
            $table->unsignedBigInteger('destination_cost_center_id');
            $table->unsignedBigInteger('cost_category_id');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->timestamps();
            $table->foreign('source_cost_center_id')->references('id')->on('cost_centers');
            $table->foreign('destination_cost_center_id')->references('id')->on('cost_centers');
            $table->foreign('cost_category_id')->references('id')->on('cost_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_allocations');
    }
}
