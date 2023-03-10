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
        Schema::create('crop_location_block_commodity_varieties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('crop_location_block_id')->index();
            $table->bigInteger('crop_commidties_verity_id')->index();
            $table->foreign('crop_location_block_id')->references('id')->on('crop_location_blocks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('crop_commidties_verity_id')->references('id')->on('crop_commodity_varieties')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('crop_location_block_commodity_varieties');
    }
};
