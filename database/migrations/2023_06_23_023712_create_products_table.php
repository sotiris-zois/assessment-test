<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->index('name_index');
            $table->string('code')->unique('unique_product_ode');
            $table->bigInteger('category_id',false,true)->index('category_id_index');
            $table->decimal('price',8,2,true);
            $table->date('release_date');
            $table->date('created_at')->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->date('updated_at')->nullable();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
