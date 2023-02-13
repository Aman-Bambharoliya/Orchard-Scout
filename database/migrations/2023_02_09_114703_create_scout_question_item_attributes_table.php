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
        Schema::create('scout_question_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scout_question_item_id');
            $table->string('label');          
            $table->timestamps();
            $table->index('scout_question_item_id');
            $table->foreign('scout_question_item_id')->references('id')->on('scout_question_items')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scout_question_item_attributes');
    }
};
