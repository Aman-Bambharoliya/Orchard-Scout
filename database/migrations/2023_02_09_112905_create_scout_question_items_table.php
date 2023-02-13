<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scout_question_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scout_report_id')->index();
            $table->foreign('scout_report_id')->references('id')->on('scout_reports')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('scout_report_category_id');
            $table->integer('commodity_id');
            $table->integer('position');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index('scout_report_category_id');
            $table->foreign('scout_report_category_id')->references('id')->on('scout_report_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scout_question_items');
    }
};
