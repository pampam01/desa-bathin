<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'masyarakat')->first();
        $admin = User::where('role', 'admin')->first();

        $newsList = [
            [
                'title' => 'pemberangkatan haji tahun 2025',
                'user_id' => $admin->id,
                'slug' => Str::slug('Pemberangkatan Haji Tahun 2025'),
                'image' => "news_images/jalan.jpg",
                'category' => 'haji',
                'tags' => 'haji, pemberangkatan, desa',
                'content' => 'Pemberangkatan haji tahun 2025 diadakan di Desa bathin.',
                'published_at' => now()->subDays(7),
                'status' => 'published',
            ],
            [
                'title' => 'penyelesaian kasus perceraian di KUA Bathin',
                'user_id' => $admin->id,
                'slug' => Str::slug('Penyelesaian Kasus Perceraian di KUA Bathin'),
                'image' => "news_images/perceraian.jpg",
                'category' => 'perceraian',
                'tags' => 'perceraian, kasus, desa',
                'content' => 'Kasus perceraian di KUA Bathin telah terselesaikan.',
                'published_at' => now()->subDays(3),
                'status' => 'published',
            ],
            [
                'title' => 'data pernikahan di KUA bathin tahun 2024',
                'user_id' => $admin->id,
                'slug' => Str::slug('Data Pernikahan di KUA Bathin Tahun 2024'),
                'image' => "news_images/pernikahan.jpg",
                'category' => 'pernikahan',
                'tags' => 'pernikahan, data, desa',
                'content' => 'Data pernikahan di KUA Bathin tahun 2024 telah tersedia.',
                'published_at' => null,
                'status' => 'published',
            ],
        ];

        foreach ($newsList as $news) {
            News::create($news);
        }
    }
}
