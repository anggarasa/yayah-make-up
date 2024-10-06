<?php

use App\Livewire\Pages\Admin\Category\Product\CategoryProduct;
use App\Livewire\Pages\Admin\Crud\Baju\CrudBajuPernikahan;
use App\Livewire\Pages\Admin\Product\Baju\BajuPernikahan;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['admin'])->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.admin-dashboard');
  })->name('dashboard-admin');

  // Category
  Route::prefix('category')->group(function() {
    Route::get('/product', CategoryProduct::class)->name('category-product');
  });

  Route::prefix('product')->group(function() {
    Route::get('/baju-pernikahan', BajuPernikahan::class)->name('baju-pernikahan');
    Route::get('/baju-pernikahan/create', CrudBajuPernikahan::class)->name('baju-pernikahan-create');
    Route::get('/baju-pernikahan/{id}/edit', CrudBajuPernikahan::class)->name('baju-pernikahan-update');
  });
});