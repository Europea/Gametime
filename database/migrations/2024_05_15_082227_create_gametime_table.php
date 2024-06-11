<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gametime', function (Blueprint $table) {
            $table->increments('idgametime');
            $table->dateTime('datum');
            $table->time('tijd');
            $table->integer('kosten');
            $table->tinyInteger('geblokt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gametime');
    }
};
