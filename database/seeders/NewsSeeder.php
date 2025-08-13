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
                'image' => url('https://images.unsplash.com/photo-1513072064285-240f87fa81e8?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
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
                'image' => url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
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
                'image' => url('https://images.unsplash.com/photo-1580418827493-f2b22c0a76cb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8aXNsYW18ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60'),
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
