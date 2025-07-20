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

        $newsList = [
            [
                'title' => 'Pembangunan Jalan Baru di Desa Parakan',
                'user_id' => $user->id,
                'slug' => Str::slug('Pembangunan Jalan Baru di Desa Parakan'),
                'image' => "news_images/jalan.jpg",
                'category' => 'Infrastruktur',
                'tags' => 'jalan, pembangunan, desa',
                'content' => 'Pemerintah Desa Parakan memulai pembangunan jalan baru untuk memperlancar akses antar dusun.',
                'published_at' => now()->subDays(7),
                'status' => 'published',
            ],
            [
                'title' => 'Kegiatan Posyandu Bulan Juli',
                'user_id' => $user->id,
                'slug' => Str::slug('Kegiatan Posyandu Bulan Juli'),
                'image' => "news_images/posyandu.jpg",
                'category' => 'Kesehatan',
                'tags' => 'posyandu, kesehatan, ibu-anak',
                'content' => 'Kegiatan posyandu diadakan di Balai Desa Parakan dengan partisipasi puluhan ibu dan balita.',
                'published_at' => now()->subDays(3),
                'status' => 'published',
            ],
            [
                'title' => 'Sosialisasi Bank Sampah Parakan',
                'user_id' => $user->id,
                'slug' => Str::slug('Sosialisasi Bank Sampah Parakan'),
                'image' => "news_images/sampah.jpg",
                'category' => 'Lingkungan',
                'tags' => 'sampah, lingkungan, sosialisasi',
                'content' => 'Desa Parakan mengadakan sosialisasi pengelolaan sampah untuk mendukung program bank sampah.',
                'published_at' => null,
                'status' => 'draft',
            ],
        ];

        foreach ($newsList as $news) {
            News::create($news);
        }
    }
}
