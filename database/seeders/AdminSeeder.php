<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::create([
        'name' => 'Yayah Make Up',
        'email' => 'yayahmakeup13@gmail.com',
        'password' => bcrypt('admin123'),
        ]);
    }
}
