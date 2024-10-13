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
        Schema::create('product_baju', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('baju_pernikahan_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Resepsi', 'Akad']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_baju');
    }
};
