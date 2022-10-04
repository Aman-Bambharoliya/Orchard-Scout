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
        Schema::create('crop_commodity_varieties', function (Blueprint $table) {
            $table->id();
            $table->integer('crop_commodity_id')->index();
            $table->foreign('crop_commodity_id')->references('id')->on('crop_commodities')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->string('name',32);
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
        Schema::dropIfExists('crop_commodity_varieties');
    }
};
