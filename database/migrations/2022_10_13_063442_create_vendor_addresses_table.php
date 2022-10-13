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
        Schema::create('vendor_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('address_type_id')->unsigned()->nullable(true);
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('address_type_id')->references('id')->on('address_types')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('vendor_addresses');
    }
};
