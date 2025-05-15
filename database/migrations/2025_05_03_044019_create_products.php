<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
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
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price_per_kg_inr', 8, 2); // 999999.99 max
            $table->tinyInteger('discount_type')->default(0); // 0 = %, 1 = flat, etc.
            $table->integer('discount')->default(0);
            $table->tinyInteger('status')->default(1); // 1 = active
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_category')->onDelete('cascade');
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
