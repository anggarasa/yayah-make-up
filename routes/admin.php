<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['admin'])->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.admin-dashboard');
  })->name('dashboard-admin');
});