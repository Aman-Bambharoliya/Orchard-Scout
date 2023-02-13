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
        Schema::create('scout_answer_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scout_report_id')->index();
            $table->foreign('scout_report_id')->references('id')->on('scout_reports')->onDelete('cascade');
            $table->bigInteger('scout_question_item_id')->index();
            $table->foreign('scout_question_item_id')->references('id')->on('scout_question_items')->onDelete('cascade');
            $table->text('comment')->nullable(true);
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
        Schema::dropIfExists('scout_answer_reports');
    }
};
