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
        Schema::create('question_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_item_id');
            $table->string('label');          
            $table->timestamps();
            $table->index('question_item_id');
            $table->foreign('question_item_id')->references('id')->on('question_items')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_item_attributes');
    }
};
