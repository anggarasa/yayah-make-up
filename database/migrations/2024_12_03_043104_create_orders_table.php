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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('diskon_id')->nullable()->constrained('diskons')->nullOnDelete();
            $table->foreignId('akad_dress_id')->nullable()->constrained('baju_pernikahans')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->date('tanggal_pernikahan');
            $table->decimal('total_harga', 15, 2);
            $table->string('payment_type')->nullable();
            $table->string('status_payment')->default('pending');
            $table->enum('status', [
                'pembayaran',
                'diproses',
                'dikirim',
                'dibatalkan',
                'selesai',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
