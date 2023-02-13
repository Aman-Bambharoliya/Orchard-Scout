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
        Schema::create('scout_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->date('date');
            $table->bigInteger('crop_location_id')->index();
            $table->foreign('crop_location_id')->references('id')->on('crop_locations')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->integer('crop_commodity_id')->index();
            $table->foreign('crop_commodity_id')->references('id')->on('crop_commodities')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->text('general_comments')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scout_reports');
    }
};
