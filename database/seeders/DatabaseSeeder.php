<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Gue Admin',
        //     'email' => 'admin@parakan.id',
        //     'role' => 'admin',
        //     'password' => bcrypt('password'), // Password is 'password'
        // ]);


        $this->call(ComplaintSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
