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
        Schema::create('customer_phones', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('phone_id')->unsigned();
            $table->integer('phone_type_id')->unsigned()->nullable(true);
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('phone_type_id')->references('id')->on('phone_types')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('customer_phones');
    }
};
