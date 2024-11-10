<?php

use App\Livewire\Pages\Admin\User\DetailProductUser;
use App\Livewire\Pages\User\Category\DetailCategory;
use App\Livewire\Pages\User\Home;
use App\Livewire\Pages\User\Order\CheckoutProduct;
use App\Livewire\Pages\User\Order\DetailOrder;
use App\Livewire\Pages\User\Order\MyOrder;
use App\Livewire\Pages\User\Profile\EditProfileUser;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirect.if.admin', 'verified'])->group(function () {
  Route::get('/home', Home::class)->name('dashboard');

  Route::prefix('detail')->group(function () {
    Route::get('/product/{id}', DetailProductUser::class)->name('detail-product-user');
    Route::get('/category/{slug}', DetailCategory::class)->name('detail-category-user');

    Route::get('/checkout/{product}', CheckoutProduct::class)->name('checkout');
    Route::get('/pesanan-saya/{order}', DetailOrder::class)->name('detail-pesanan');
  });

  Route::get('/profile/{name}', EditProfileUser::class)->name('profile-user');
  Route::get('/pesanan-saya', MyOrder::class)->name('myOrder-user');
});