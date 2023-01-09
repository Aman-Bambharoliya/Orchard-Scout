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
        Schema::create('question_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scout_report_category_id');
            $table->json('commodity_types')->nullable(true);
            $table->integer('position');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropForeign('question_items_scout_report_category_id_foreign');
        Schema::dropIndex('question_items_scout_report_category_id_index');
        Schema::dropColumn('scout_report_category_id');
        Schema::dropIfExists('question_items');
    }
};
