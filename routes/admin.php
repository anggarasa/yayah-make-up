<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Admin\Order\ShowOrder;
use App\Livewire\Pages\Admin\Order\DaftarOrder;
use App\Livewire\Notifications\AdminNotification;
use App\Livewire\Pages\Admin\Product\Paket\ListProduct;
use App\Livewire\Pages\Admin\Product\Paket\ShowProduct;
use App\Livewire\Pages\Admin\Product\Baju\BajuPernikahan;
use App\Livewire\Pages\Admin\Product\Paket\CreateProduct;
use App\Livewire\Pages\Admin\Product\Paket\DeleteProduct;
use App\Livewire\Pages\Admin\Product\Paket\UpdateProduct;
use App\Livewire\Pages\Admin\Crud\Baju\CrudBajuPernikahan;
use App\Livewire\Pages\Admin\Question\ListQuestionWelcome;
use App\Livewire\Pages\Admin\Question\ShowQuestionWelcome;
use App\Livewire\Pages\Admin\Category\Product\CategoryProduct;
use App\Livewire\Pages\Admin\Diskon\ManagementDiskon;

Route::prefix('admin')->middleware(['admin'])->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.admin-dashboard');
  })->name('dashboard-admin');

  // Category
  Route::prefix('category')->group(function() {
    Route::get('/product', CategoryProduct::class)->name('category-product');
  });

  Route::prefix('product')->group(function() {
    Route::get('/list-product', ListProduct::class)->name('list-product');
    Route::get('/create-product', CreateProduct::class)->name('create-product');
    Route::get('/update-product/{id}', UpdateProduct::class)->name('update-product');
    Route::get('/delete-product/{id}', DeleteProduct::class)->name('delete-product');
    Route::get('/show-product/{id}', ShowProduct::class)->name('show-product');
    
    Route::get('/baju-pernikahan', BajuPernikahan::class)->name('baju-pernikahan');
    Route::get('/baju-pernikahan/create', CrudBajuPernikahan::class)->name('baju-pernikahan-create');
    Route::get('/baju-pernikahan/{id}/edit', CrudBajuPernikahan::class)->name('baju-pernikahan-update');
  });

  Route::prefix('question')->group(function() {
    Route::get('/list-question', ListQuestionWelcome::class)->name('list-question');
    Route::get('/show-question/{question}', ShowQuestionWelcome::class)->name('show-question');
  });

  Route::prefix('order')->name('order.')->group(function() {
    Route::get('/daftar-order', DaftarOrder::class)->name('daftar-order');
    Route::get('/show-order/{order}', ShowOrder::class)->name('show-order');
  });

  Route::prefix('diskon&promo')->name('diskon-promo.')->group(function() {
    Route::get('/management-diskon', ManagementDiskon::class)->name('management-diskon');
  });

  Route::get('/notification', AdminNotification::class)->name('admin-notification');
  
});