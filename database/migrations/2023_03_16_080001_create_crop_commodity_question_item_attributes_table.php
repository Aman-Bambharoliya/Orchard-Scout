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
        Schema::create('crop_commodity_question_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('crop_commodity_id');
            $table->bigInteger('question_item_attribute_id');
            $table->foreign('crop_commodity_id')->references('id')->on('crop_commodities')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('question_item_attribute_id')->references('id')->on('question_item_attributes')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('crop_commodity_question_item_attributes');
    }
};
