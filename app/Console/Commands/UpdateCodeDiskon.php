<?php

namespace App\Console\Commands;

use App\Models\Diskon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateCodeDiskon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:code-discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbarui code diskon berdasarkan tanggal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Aktifkan diskon yang mulai hari ini
        $activeDiscounts = Diskon::where('start_date', $today)
                ->where('is_active', false)
                ->get();

        foreach ($activeDiscounts as $discount) {
            $discount->update(['is_active' => true]);
        }

        // Non-aktifkan yang sudah lewati hari ini
        $expiredDiscounts = Diskon::where('end_date', '<=', $today)
            ->where('is_active', true)
            ->get();

        foreach ($expiredDiscounts as $discount) {
            $discount->update(['is_active' => false]);
        }

        $this->info("Code diskon di perbarui");
    }
}
