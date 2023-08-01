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
        Schema::create('matcheds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('manid');
            $table->foreign('manid')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('womanid');
            $table->foreign('womanid')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('liked');
            $table->foreign('liked')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('matcheds');
    }
};
