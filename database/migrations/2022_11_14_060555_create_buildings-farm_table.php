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
        Schema::create('buildings-farm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farm_id');
            $table->unsignedBigInteger('building_id');
            $table->timestamps();

            $table->foreign('farm_id')->references('id')->on('farm_lands');
            $table->foreign('building_id')->references('id')->on('buildings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings-farm');
    }
};
