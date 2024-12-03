<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(AdminSeeder::class);
        $this->call(CategoryProductSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(BajuPernikahanSeeder::class);

        User::factory()->create([
            'name' => 'Anggara Saputra',
            'username' => 'Anggara', 
            'gender' => 'laki-laki',
            'email' => 'anggasaputra6609@gmail.com',
            'phone_number' => '085861235561',
            'age' => '2006-06-11',
            'password' => bcrypt('anggara-sa'),
        ]);
        
        User::factory()->create([
            'name' => 'Ridawan Saputra',
            'username' => 'Ridwab', 
            'gender' => 'laki-laki',
            'email' => 'anggasaputra6259@gmail.com',
            'phone_number' => '081224242608',
            'age' => '2006-05-11',
            'password' => bcrypt('anggara-sa'),
        ]);
    }
}
