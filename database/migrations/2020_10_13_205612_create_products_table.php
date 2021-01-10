<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('body')->nullable();
            $table->float('price');
            $table->string('in_stock');
            $table->boolean('is_published')->default(1);
            $table->integer('views_count')->default(0);
            $table->boolean('publish_price')->default(1);
            $table->boolean('recommended')->default(0);
            $table->unsignedInteger('sort_order')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
