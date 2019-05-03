<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();


        });

        Schema::table('category_relations', function ($table) {
            $table->foreign('products_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

        });

        Schema::table('category_relations', function ($table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
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
        Schema::dropIfExists('category_relations');
    }
}
