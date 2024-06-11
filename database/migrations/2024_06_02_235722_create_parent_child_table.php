<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_child', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');
            $table->timestamps();
        

            $table->unique(['parent_id', 'child_id']);
        

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_child');
    }
}
