<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryProduct::create(['name' => 'PAKET AKAD', 'slug' => 'paket-akad']);
        CategoryProduct::create(['name' => 'PAKET MELATI', 'slug' => 'paket-melati']);
        CategoryProduct::create(['name' => 'PAKET MAWAR', 'slug' => 'paket-mawar']);
        CategoryProduct::create(['name' => 'PAKET TERATAI', 'slug' => 'paket-teratai']);
        CategoryProduct::create(['name' => 'PAKET TULIP', 'slug' => 'paket-tulip']);
        CategoryProduct::create(['name' => 'PAKET SILVER', 'slug' => 'paket-silver']);
        CategoryProduct::create(['name' => 'PAKET GOLD', 'slug' => 'paket-gold']);
        CategoryProduct::create(['name' => 'PAKET JASA MAKE - UP & KOSTUM', 'slug' => 'paket-jasa-make-up-dan-kustom']);
        CategoryProduct::create(['name' => 'PAKET REQUEST', 'slug' => 'paket-request']);
    }
}
