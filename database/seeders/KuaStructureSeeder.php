<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KuaStructure;

class KuaStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            // Kepala Kemenag
            [
                'name' => 'Muhammad Tohir',
                'position' => 'Kepala Kantor Kementerian Agama',
                'level' => 'kepala_kemenag',
                'department' => "Pemimpin",
                'description' => 'Memimpin kantor Kementerian Agama dan bertanggung jawab atas seluruh kegiatan keagamaan',
                'sort_order' => 1
            ],

            // Kesubagg TU
            [
                'name' => 'Didin Jamaludin, S.pd I',
                'position' => 'Kepala Subbag Tata Usaha',
                'level' => 'kesubagg_tu',
                'department' => 'Tata Usaha',
                'description' => 'Mengurus administrasi umum dan ketatausahaan kantor',
                'sort_order' => 2
            ],

            // Kasi Bimas Islam
            [
                'name' => 'Ika Rostika',
                'position' => 'Kasi Bimas Islam',
                'level' => 'kasi_bimas_islam',
                'department' => 'Bimas Islam',
                'description' => 'Mengurus bidang bimbingan masyarakat Islam',
                'sort_order' => 3
            ],

            // Kepala KUA
            [
                'name' => 'Nur M Iskandar, S.Kom',
                'position' => 'Kepala KUA',
                'level' => 'kepala_kua',
                'department' => 'KUA',
                'description' => 'Mengurus urusan agama dan pernikahan',
                'sort_order' => 4
            ],

            // Pengadministrasi
            [
                'name' => 'Pebriyana',
                'position' => 'Pengadministrasi Umum',
                'level' => 'pengadministrasi',
                'department' => 'Administrasi',
                'description' => 'Mengurus administrasi umum kantor',
                'sort_order' => 5
            ],

            // Operator Simkah
            [
                'name' => 'Moch Baim Syaefullah',
                'position' => 'Operator Simkah',
                'level' => 'operator_simkah',
                'department' => 'Sistem Informasi',
                'description' => 'Mengoperasikan sistem informasi manajemen haji dan umrah',
                'sort_order' => 6
            ],

            // Pramu Kantor
            [
                'name' => 'Abdul Kholiq Akhyar',
                'position' => 'Pramu Kantor',
                'level' => 'pramu_kantor',
                'department' => 'Pelayanan',
                'description' => 'Melayani tamu dan mengurus kebersihan kantor',
                'sort_order' => 7
            ],
        ];

        foreach ($structures as $structure) {
            KuaStructure::create($structure);
        }
    }
}
