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
       Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->unsignedBigInteger('category')->nullable(); // 0 for None
            $table->tinyInteger('status')->default(0);
            $table->text('description')->nullable();

            $table->string('price')->nullable();        // can change to decimal
            $table->string('sale_price')->nullable();   // can change to decimal
            $table->integer('quantity')->default(0);
            $table->string('sku')->nullable();

            $table->json('attributes')->nullable();
            $table->json('labels')->nullable();
            $table->json('taxes')->nullable();

            $table->string('featured_image_1')->nullable();
            $table->string('featured_image_2')->nullable();
            $table->string('featured_image_3')->nullable();

            $table->timestamps();
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
