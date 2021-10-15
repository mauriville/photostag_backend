<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TagImage', function (Blueprint $table) {
            $table->integer('Tag')->unsigned()->nullable();
            $table->integer('Image')->unsigned()->nullable();

            $table->nullableTimestamps();
            $table->SoftDeletes();

            $table->foreign('Tag')->references('id')->on('Tag');
            $table->foreign('Image')->references('id')->on('Image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('TagImage');
    }
}
