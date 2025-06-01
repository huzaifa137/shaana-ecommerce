<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('password_reset_tables', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('token');
            $table->timestamps();
            $table->integer('link_status')->default(0);
            $table->primary('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tables');
    }
};
