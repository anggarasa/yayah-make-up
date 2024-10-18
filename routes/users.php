<?php

use App\Livewire\Pages\Admin\User\DetailProductUser;
use App\Livewire\Pages\User\Category\DetailCategory;
use App\Livewire\Pages\User\Home;
use App\Livewire\Pages\User\ShowProduct;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirect.if.admin', 'verified'])->group(function () {
  Route::get('/home', Home::class)->name('dashboard');

  Route::prefix('detail')->group(function () {
    Route::get('/product/{id}', DetailProductUser::class)->name('detail-product-user');
    Route::get('/category/{slug}', DetailCategory::class)->name('detail-category-user');
  });
});