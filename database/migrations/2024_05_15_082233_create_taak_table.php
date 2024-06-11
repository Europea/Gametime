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
        Schema::create('taak', function (Blueprint $table) {
            $table->increments('idtaak');
            $table->string('omschrijving', 45);
            $table->integer('waardepunten');
            $table->date('datum');
            $table->tinyInteger('voltooid');
            $table->string('gedragsnotitie', 255);
            $table->unsignedBigInteger('controller_idcontroller');
            $table->unsignedBigInteger('kind_id');

            $table->foreign('controller_idcontroller')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('kind_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->index('controller_idcontroller', 'fk_taak_user_idx');
            $table->index('kind_id', 'fk_taak_kind_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taak');
    }
};
