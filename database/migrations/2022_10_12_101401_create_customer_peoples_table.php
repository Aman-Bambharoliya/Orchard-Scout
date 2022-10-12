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
        Schema::create('customer_peoples', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('people_id')->unsigned();
            $table->integer('people_role_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('people_id')->references('id')->on('peoples')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('people_role_id')->references('id')->on('people_roles')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('customer_peoples');
    }
};
