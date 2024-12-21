<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\DiskonProduct;
use Illuminate\Console\Command;

class UpdateProductDiscount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:product-discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbarui harga diskon produk berdasarkan tanggal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Aktifkan diskon yang mulai hari ini
        $activeDiscounts = DiskonProduct::where('start_date', $today)
            ->where('is_active', true)
            ->get();

        foreach ($activeDiscounts as $discount) {
            foreach ($discount->products as $product) {
                $hargaDiskon = $discount->type === 'fixed'
                    ? $product->harga - $discount->jumlah_diskon
                    : $product->harga - ($product->harga * ($discount->jumlah_diskon / 100));

                $product->update(['harga_diskon' => $hargaDiskon]);
            }
        }

        // Nonaktifkan diskon yang berakhir hari ini
        $expiredDiscounts = DiskonProduct::where('end_date', '<=', $today)
            ->where('is_active', true)
            ->get();

        foreach ($expiredDiscounts as $discount) {
            foreach ($discount->products as $product) {
                $product->update(['harga_diskon' => null]);
            }
        }

        $this->info('Produk diskon diperbarui.');
    }
}
