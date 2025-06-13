<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

      public function up(): void {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->string('reviewer_name');
            $table->string('reviewer_email')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->text('review_message');
            $table->date('review_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_reviews');
    }
    
};
