<?php

namespace Database\Seeders;

use App\Models\BajuPernikahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BajuPernikahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BajuPernikahan::create([
            'name' => 'Baju Akad 1',
            'image_dress' => 'componen-wedding-3.jpg',
            'dress_type' => 'Akad'
        ]);
        
        BajuPernikahan::create([
            'name' => 'Baju Akad 2',
            'image_dress' => 'componen-wedding-14.jpg',
            'dress_type' => 'Akad'
        ]);
        
        BajuPernikahan::create([
            'name' => 'Baju Resepsi 1',
            'image_dress' => 'componen-wedding-1.jpg',
            'dress_type' => 'Resepsi'
        ]);

        BajuPernikahan::create([
            'name' => 'Baju Resepsi 2',
            'image_dress' => 'componen-wedding-2.jpg',
            'dress_type' => 'Resepsi'
        ]);

        BajuPernikahan::create([
            'name' => 'Baju Resepsi 3',
            'image_dress' => 'componen-wedding-4.jpg',
            'dress_type' => 'Resepsi'
        ]);

        BajuPernikahan::create([
            'name' => 'Baju Resepsi 4',
            'image_dress' => 'componen-wedding-5.jpg',
            'dress_type' => 'Resepsi'
        ]);
    }
}
