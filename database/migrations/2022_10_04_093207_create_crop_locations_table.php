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
        Schema::create('crop_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->string('name',64);
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
        Schema::dropIfExists('crop_locations');
    }
};
