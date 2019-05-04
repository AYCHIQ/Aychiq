<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagebles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('images_id');
            $table->unsignedBigInteger('imageble_id');
            $table->string('imageble_type');
            $table->timestamps();
        });

        Schema::table('imagebles', function ($table) {
            $table->foreign('images_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagebles');
    }
}
