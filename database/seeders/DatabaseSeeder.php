<?php

namespace Database\Seeders;

use App\Models\AboutVillage;
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
        AboutVillage::create([
            'people_total' => 1000,
            'family_total' => 250,
            'blok_total' => 5,
            'program_total' => 3,
            'description' => 'Desa Parakan adalah desa yang terletak di kaki gunung dengan pemandangan alam yang indah.',
            'visi' => 'Mewujudkan desa yang mandiri dan sejahtera.',
            'misi' => 'Meningkatkan kualitas hidup masyarakat melalui program-program pembangunan.',
            'location' => 'Jl. Raya Parakan No.1, Desa Parakan',
            'no_telp' => '081234567890',
            'email' => 'info@parakan.id'
        ]);
    }
}
