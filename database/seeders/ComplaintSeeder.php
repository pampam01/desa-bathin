<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin KUA',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin1234'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'KUA bathin',
                'bio' => 'Saya adalah admin desa yang bertugas mengelola laporan masyarakat.',
                'avatar' => null,
            ],
            [
                'name' => 'Pampam Warga',
                'email' => 'pampam@gmail.com',
                'password' => bcrypt('pampam1234'),
                'role' => 'masyarakat',
                'phone' => '081298765432',
                'address' => 'Warga Desa Bathin',
                'bio' => 'Warga aktif yang peduli terhadap lingkungan sekitar.',
                'avatar' => null,
            ],
            [
                'name' => 'Siti',
                'email' => 'siti@parakan.id',
                'password' => bcrypt('siti1234'),
                'role' => 'masyarakat',
                'phone' => '082112345678',
                'address' => 'Warga Desa Bathin',
                'bio' => 'Senang menyuarakan aspirasi melalui sistem desa digital.',
                'avatar' => null,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $user = User::first();

        foreach ($users as $userData) {
            User::updateOrCreate(['email' => $userData['email']], $userData);
        }

        // Ambil user masyarakat pertama untuk assign ke complaint
        $admin = User::where('id', 2)->first();

        $complaints = [
            [
                'title' => 'Jalan rusak di RT 03 RW 01',
                'description' => 'Jalan utama di RT 03 berlubang dan membahayakan pengendara motor terutama saat hujan.',
                'status' => 'draft',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'Infrastruktur',
            ],
            [
                'title' => 'Lampu penerangan mati',
                'description' => 'Lampu jalan di sekitar balai desa mati sejak seminggu lalu, mohon perbaikannya.',
                'status' => 'draft',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'Fasilitas Umum',
            ],
            [
                'title' => 'Sampah menumpuk di selokan',
                'description' => 'Selokan depan SD Parakan 1 tersumbat karena sampah menumpuk, menimbulkan bau tidak sedap.',
                'status' => 'in_progress',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'Kebersihan',
            ],
            [
                'title' => 'Air PAM tidak mengalir',
                'description' => 'Sudah 2 hari air PAM di RW 05 tidak mengalir. Warga kesulitan air bersih.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'Pelayanan Umum',
            ]
        ];

        foreach ($complaints as $complaintData) {
            Complaint::create($complaintData);
        }
    }
}
