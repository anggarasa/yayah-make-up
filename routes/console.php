<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Update diskon product
Schedule::command('update:product-discount')->dailyAt('00:00')->evenInMaintenanceMode();

// Update code diskon
Schedule::command('update:code-discount')->dailyAt('00:00')->evenInMaintenanceMode();