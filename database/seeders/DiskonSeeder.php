<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\Clock\now;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diskon::create([
            'code' => 'DISKON1212',
            'harga_diskon' => '500000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'PORP42',
            'harga_diskon' => '67',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'RFDS42',
            'harga_diskon' => '800000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'EFW43',
            'harga_diskon' => '55',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'GJKEWW912',
            'harga_diskon' => '66',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'DWLW21',
            'harga_diskon' => '77',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'KFLDAK32',
            'harga_diskon' => '1000000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);
        
        Diskon::create([
            'code' => 'JKFDAN442',
            'harga_diskon' => '850000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'JFDKMFE23',
            'harga_diskon' => '900000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'FDAMFEa121',
            'harga_diskon' => '1200000',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'JKFDAMEa5334',
            'harga_diskon' => '80',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'EWFDAE3234',
            'harga_diskon' => '90',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'JFKDA3245',
            'harga_diskon' => '70',
            'type' => 'percentage',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Diskon::create([
            'code' => 'KFLDAHEA',
            'harga_diskon' => '200453',
            'type' => 'fixed',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);
    }
}
