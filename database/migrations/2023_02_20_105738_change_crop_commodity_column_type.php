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
        Schema::table('scout_reports', function (Blueprint $table) {
            $table->dropForeign('scout_reports_crop_commodity_id_foreign');
            $table->dropColumn('crop_commodity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scout_reports', function (Blueprint $table) {
            //
        });
    }
};