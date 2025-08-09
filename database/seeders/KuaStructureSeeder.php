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
                'name' => 'Drs Al Jufri M.Pdi',
                'position' => 'Kepala Kemenag',
                'level' => 'kepala_kemenag',
                'department' => "Pemimpin",
                'description' => 'Memimpin kantor Kementerian Agama dan bertanggung jawab atas seluruh kegiatan keagamaan',
                'sort_order' => 1
            ],

            // Kesubagg TU
            [
                'name' => 'M. Muslim. S.Ag, M.Sy',
                'position' => 'Kepala Kesubbag TU',
                'level' => 'kesubagg_tu',
                'department' => 'Tata Usaha',
                'description' => 'Mengurus administrasi umum dan ketatausahaan kantor',
                'sort_order' => 2
            ],

            // Kasi Bimas Islam
            [
                'name' => 'Abdul Rahman, S.Ag',
                'position' => 'Kasi Bimas Islam',
                'level' => 'kasi_bimas_islam',
                'department' => 'Bimas Islam',
                'description' => 'Mengurus bidang bimbingan masyarakat Islam',
                'sort_order' => 3
            ],

            // Kepala KUA
            [
                'name' => 'M.Azman, S.Ag',
                'position' => 'Kepala KUA',
                'level' => 'kepala_kua',
                'department' => 'KUA',
                'description' => 'Mengurus urusan agama dan pernikahan',
                'sort_order' => 4
            ],

            // Pengadministrasi
            [
                'name' => 'M. Sodik',
                'position' => 'Pengadministrasi Nikah Rujuk',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi nikah rujuk',
                'sort_order' => 5
            ],
            [
                'name' => 'Hesti Yuka Ningsih',
                'position' => 'Pengadministrasi Zawibosos',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi zawibosos',
                'sort_order' => 5
            ],
            [
                'name' => 'Yulia Ningsih',
                'position' => 'Pengadministrasi kemasjidan',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi kemasjidan',
                'sort_order' => 5
            ],
            [
                'name' => 'Hanapi S.H.I',
                'position' => 'Pengadministrasi Haji/Umrah',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi haji/umrah',
                'sort_order' => 5
            ],
            [
                'name' => 'Muamar',
                'position' => 'Pengadministrasi lintas sektoral',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi lintas sektor',
                'sort_order' => 5
            ],
            [
                'name' => 'Hanafi',
                'position' => 'Pengadministrasi Produk Halal',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi produk halal',
                'sort_order' => 5
            ],
            [
                'name' => 'Hesti Yulia Ningsih',
                'position' => 'Pengadministrasi Umum',
                'level' => 'pengadministrasi',
                'department' => 'KUA',
                'description' => 'Mengurus administrasi umum',
                'sort_order' => 5
            ],
            // Operator Simkah
            [
                'name' => 'Muamar',
                'position' => 'Operator Simkah',
                'level' => 'operator_simkah',
                'department' => 'Sistem Informasi',
                'description' => 'Mengoperasikan sistem informasi manajemen haji dan umrah',
                'sort_order' => 6
            ],

            // Pramu Kantor
            [
                'name' => 'Indah',
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
