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
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama Admin
            $table->string('email')->unique();  // Email Admin
            $table->string('password');  // Password Admin
            $table->string('role')->default('admin');  // Role admin (misalnya admin atau superadmin)
            $table->rememberToken();  // Untuk fungsi "remember me" saat login
            $table->timestamps();  // Tanggal dibuat dan diperbarui
            $table->softDeletes();  // Kolom ini untuk fitur soft delete (penghapusan sementara)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
