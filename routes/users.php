<?php

use App\Livewire\Pages\User\Home;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'redirect.if.admin'])->group(function () {
  Route::get('/home', Home::class)->name('user-home');
});