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
        CategoryProduct::create(['name' => 'Paket Akad', 'slug' => 'paket-akad']);
        CategoryProduct::create(['name' => 'Paket Melati', 'slug' => 'paket-melati']);
        CategoryProduct::create(['name' => 'Paket Mawar', 'slug' => 'paket-mawar']);
        CategoryProduct::create(['name' => 'Paket Teratai', 'slug' => 'paket-teratai']);
        CategoryProduct::create(['name' => 'Paket Tulip', 'slug' => 'paket-tulip']);
        CategoryProduct::create(['name' => 'Paket Silver', 'slug' => 'paket-silver']);
        CategoryProduct::create(['name' => 'Paket Gold', 'slug' => 'paket-gold']);
        CategoryProduct::create(['name' => 'Paket Request', 'slug' => 'paket-request']);
        CategoryProduct::create(['name' => 'Paket Jasa Make - Up & Kostum', 'slug' => 'paket-jasa-make-up-dan-kustom']);
    }
}
