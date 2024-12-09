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
        Schema::create('diskon_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('jumlah_diskon', 15, 2); // Jumlah diskon
            $table->enum('type', ['fixed', 'percentage']); // Tipe diskon (tetap atau persentase)
            $table->date('start_date'); // Tanggal mulai
            $table->date('end_date'); // Tanggal berakhir
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon_products');
    }
};
