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
            $table->integer('added_by')->nullable(false)->index();
            $table->foreign('added_by')->references('id')->on('admins')->onDelete('RESTRICT');

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
