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
                'bio' => 'Saya adalah admin KUA yang bertugas mengelola laporan masyarakat.',
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
                'title' => 'masalah perkawinan',
                'description' => 'masalah perkawinan, mohon perbaikannya.',
                'status' => 'draft',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'perkawinan',
            ],
            [
                'title' => 'masalah perceraian',
                'description' => 'masalah perceraian, mohon perbaikannya.',
                'status' => 'draft',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'perceraian',
            ],
            [
                'title' => 'Masalah Rujuk',
                'description' => 'Masalah Rujuk, mohon perbaikannya.',
                'status' => 'in_progress',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'rujuk',
            ],
            [
                'title' => 'masalah keluarga',
                'description' => 'masalah keluarga, mohon perbaikannya.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'keluarga',
            ],
            [
                'title' => 'masalah pembatalan perkawinan',
                'description' => 'masalah pembatalan perkawinan, mohon perbaikannya.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'pembatalan perkawinan',
            ],
            [
                'title' => 'bimbingan keluarga',
                'description' => 'bimbingan keluarga, mohon perbaikannya.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'bimbingan keluarga',
            ],
            [
                'title' => 'bimbingan haji',
                'description' => 'bimngian haji, mohon perbaikannya.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'bimbingan haji',
            ],
            [
                'title' => 'layanan keagamaan',
                'description' => 'layanan keagamaan.',
                'status' => 'resolved',
                'user_id' => $admin->id,
                'image' => null,
                'category' => 'layanan keagamaan',
            ]
        ];

        foreach ($complaints as $complaintData) {
            Complaint::create($complaintData);
        }
    }
}
