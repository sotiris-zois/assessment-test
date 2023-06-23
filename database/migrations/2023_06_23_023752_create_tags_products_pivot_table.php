<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags_products_pivot', function (Blueprint $table) {
            $table->bigInteger('tag_id');
            $table->bigInteger('product_id');
            $table->foreign('tag_id','tag_foreign_key')->references('id')->on('tags');
            $table->foreign('product_id','product_foreign_key')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_products_pivot');
    }
};
