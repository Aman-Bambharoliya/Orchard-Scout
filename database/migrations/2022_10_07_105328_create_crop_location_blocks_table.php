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
        Schema::create('crop_location_blocks', function (Blueprint $table) {
            $table->id();
            $table->integer('crop_location_id')->unsigned();
            $table->integer('crop_commodity_id')->unsigned();
            $table->foreign('crop_location_id')->references('id')->on('crop_locations')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('crop_commodity_id')->references('id')->on('crop_commodities')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->string('name',64);
            $table->decimal('acres',10,2)->unsigned();
            $table->integer('year_planted')->unsigned()->nullable(true);
            $table->decimal('plant_feet_spacing_in_rows',5,2)->unsigned();
            $table->decimal('plant_feet_between_rows',5,2)->unsigned();
            $table->string('description',255)->nullable(true);
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
        Schema::dropIfExists('crop_location_blocks');
    }
};
