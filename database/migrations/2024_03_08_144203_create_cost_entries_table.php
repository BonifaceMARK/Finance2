<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cost_center_id');
            $table->unsignedBigInteger('cost_category_id');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->timestamps();
            $table->foreign('cost_center_id')->references('id')->on('cost_centers');
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
        Schema::dropIfExists('cost_entries');
    }
}
