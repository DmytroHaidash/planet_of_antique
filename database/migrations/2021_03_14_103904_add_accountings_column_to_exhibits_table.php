<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountingsColumnToExhibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exhibits', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->text('source')->nullable();
            $table->boolean('price')->nullable();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exhibits', function (Blueprint $table) {
            $table->dropColumn('date', 'source', 'price', 'comment');
        });
    }
}
