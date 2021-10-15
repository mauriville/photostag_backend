<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Image extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Tittle', 50)->nullable();
            $table->string('ImageUrl', 150)->nullable();
            $table->string('ThumbnailUrl', 150)->nullable();

            $table->nullableTimestamps();
            $table->SoftDeletes();
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
        Schema::dropIfExists('Image');
    }
}
