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
        Schema::table('crop_location_blocks', function (Blueprint $table) {
            $table->decimal('acres',10,2)->nullable(true)->change();
            $table->decimal('plant_feet_spacing_in_rows',5,2)->nullable(true)->change();
            $table->decimal('plant_feet_between_rows',5,2)->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crop_location_blocks', function (Blueprint $table) {
            //
        });
    }
};
