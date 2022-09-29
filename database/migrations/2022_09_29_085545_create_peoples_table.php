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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('prefix',8)->nullable(true);
            $table->string('first_name',32)->nullable(true);
            $table->string('middle_name',32)->nullable(true);
            $table->string('last_name',64)->nullable(true);
            $table->string('suffix',8)->nullable(true);
            $table->string('nickname',32)->nullable(true);
            $table->string('maiden_name',32)->nullable(true);
            $table->date('date_of_birth')->nullable(true);
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
        Schema::dropIfExists('peoples');
    }
};
