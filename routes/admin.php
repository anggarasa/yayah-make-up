<?php

use App\Livewire\Pages\Admin\Category\Product\CategoryProduct;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['admin'])->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.admin-dashboard');
  })->name('dashboard-admin');

  // Category
  Route::prefix('category')->group(function() {
    Route::get('/product', CategoryProduct::class)->name('category-product');
  });
});