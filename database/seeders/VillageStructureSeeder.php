<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\VillageStructure;

class VillageStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            // Kepala Desa
            [
                'name' => 'Muhammad Tohir',
                'position' => 'Kepala Desa',
                'level' => 'kepala_desa',
                'department' => "Pemimpin",
                'description' => 'Memimpin pemerintahan desa dan bertanggung jawab atas seluruh kegiatan pemerintahan, pembangunan, dan kemasyarakatan',
                'sort_order' => 1
            ],

            // Sekretaris Desa
            [
                'name' => 'Didin Jamaludin, S.pd I',
                'position' => 'Sekretaris Desa',
                'level' => 'sekretaris',
                'department' => 'Administrasi',
                'description' => 'Membantu Kepala Desa dalam bidang administrasi pemerintahan',
                'sort_order' => 2
            ],

            // Kepala Urusan
            [
                'name' => 'Ika Rostika',
                'position' => 'Kaur Tata Usaha dan Umum',
                'level' => 'kaur',
                'department' => 'Tata Usaha',
                'description' => 'Mengurus administrasi umum dan ketatausahaan desa',
                'sort_order' => 3
            ],
            [
                'name' => 'Nur M Iskandar, S.Kom',
                'position' => 'Kaur Keuangan',
                'level' => 'kaur',
                'department' => 'Keuangan',
                'description' => 'Mengelola keuangan dan anggaran desa',
                'sort_order' => 4
            ],

            // Kepala Seksi
            [
                'name' => 'Pebriyana',
                'position' => 'Kasi Pemerintahan',
                'level' => 'kasi',
                'department' => 'Pemerintahan',
                'description' => 'Mengurus bidang pemerintahan dan administrasi kependudukan',
                'sort_order' => 5
            ],
            [
                'name' => 'Moch Baim Syaefullah',
                'position' => 'Kasi Kesejahteraan',
                'level' => 'kasi',
                'department' => 'Kesejahteraan',
                'description' => 'Mengurus bidang kesejahteraan dan pemberdayaan masyarakat',
                'sort_order' => 6
            ],
            [
                'name' => 'Abdul Kholiq Akhyar',
                'position' => 'Kasi Pelayanan',
                'level' => 'kasi',
                'department' => 'Pelayanan',
                'description' => 'Mengurus bidang pelayanan umum kepada masyarakat',
                'sort_order' => 7
            ],

            // Kepala Dusun
            [
                'name' => 'Agus Ana Saleh',
                'position' => 'Kadus I',
                'level' => 'kadus',
                'department' => 'Dusun',
                'description' => 'Memimpin wilayah Dusun I',
                'sort_order' => 8
            ],
            [
                'name' => 'Warju',
                'position' => 'Kadus II',
                'level' => 'kadus',
                'department' => 'Dusun',
                'description' => 'Memimpin wilayah Dusun II',
                'sort_order' => 9
            ],
            [
                'name' => 'Agustinus Lukmana',
                'position' => 'Kadus III',
                'level' => 'kadus',
                'department' => 'Dusun',
                'description' => 'Memimpin wilayah Dusun III',
                'sort_order' => 10
            ],
            [
                'name' => 'Een Suheni',
                'position' => 'Kadus IV',
                'level' => 'kadus',
                'department' => 'Dusun',
                'description' => 'Memimpin wilayah Dusun IV',
                'sort_order' => 11
            ],
        ];

        foreach ($structures as $structure) {
            VillageStructure::create($structure);
        }
    }
}
