<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('budget_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_plan_id');
            $table->foreign('budget_plan_id')->references('id')->on('budget_plans')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('budget_proposals');
    }
}
