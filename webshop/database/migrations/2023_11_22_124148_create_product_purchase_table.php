<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchaseTableV2 extends Migration
{

        public function up()
    {
        Schema::create('product_purchase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total', 8, 2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::dropIfExists('product_purchase');
    }
}
