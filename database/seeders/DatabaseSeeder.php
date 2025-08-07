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
        $this->call(ComplaintSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(VillageStructureSeeder::class);
        AboutVillage::create([
            'people_total' => 1000,
            'family_total' => 250,
            'blok_total' => 4,
            'program_total' => 3,
            'description' => 'KUA bathin melayani segala kebutuhan masyarakat desa bathin',
            'visi' => 'Terwujudnya masyarakat Indonesia yang taat beragama, rukun, cerdas, mandiri, dan sejahtera lahir batin',
            'misi' => 'Meningkatkan kualitas kehidupan beragama, meningkatkan kualitas kerukunan umat beragama, meningkatkan kualitas pendidikan agama, meningkatkan kualitas penyelenggaraan ibadah haji, dan mewujudkan tata kelola pemerintahan yang bersih dan berwibawa',
            'location' => '5228+5V7, Muara Jangga, Kec. Batin XXIV, Kabupaten Batang Hari, Jambi 36656',
            'no_telp' => '082182287235',
            'email' => ''
        ]);
    }
}
