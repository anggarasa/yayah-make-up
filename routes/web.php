<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome.welcome-page');
})->name('welcome-page');

Route::get('/gallery/all', function() {
    return view('welcome.welcome-gallery');
})->name('welcome-gallery');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/users.php';
require __DIR__.'/admin.php';
