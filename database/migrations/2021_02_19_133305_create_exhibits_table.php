<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('museum_id');
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('body')->nullable();
            $table->boolean('published')->default(1);
            $table->timestamps();

            $table->foreign('museum_id')->references('id')->on('museums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibits');
    }
}
