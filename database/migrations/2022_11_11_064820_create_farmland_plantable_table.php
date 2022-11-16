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
        Schema::create('farmland_plantables', function (Blueprint $table) {
            $table->id();
            $table->integer('farmland_id')->nullable();
            $table->morphs('plantable');
            $table->integer('count')->nullable();
            $table->dateTime('planted_at');
            $table->dateTime('harvested_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmland_plantable');
    }
};
