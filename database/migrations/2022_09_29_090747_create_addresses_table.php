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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_1',32)->nullable(true);
            $table->string('address_2',32)->nullable(true);
            $table->string('city',32)->nullable(true);
            $table->string('state',32)->nullable(true);
            $table->integer('zip')->unsigned()->nullable(true);
            $table->integer('zip_plus4')->unsigned()->nullable(true);
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
        Schema::dropIfExists('addresses');
    }
};
