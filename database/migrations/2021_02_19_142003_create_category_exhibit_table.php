<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryExhibitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_exhibit', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('exhibit_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('exhibit_id')
                ->references('id')->on('exhibits')
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
        Schema::dropIfExists('category_exhibit');
    }
}
