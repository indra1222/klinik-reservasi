<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run()
    {
        $dokters = [
            [
                'nama' => 'dr. Indra mauludani efendi',
                'spesialisasi' => 'Umum',
            ],
            [
                'nama' => 'dr. roboth, Sp.A',
                'spesialisasi' => 'Anak',
            ],
            [
                'nama' => 'dr. femil, Sp.OG',
                'spesialisasi' => 'Kandungan',
            ],
            [
                'nama' => 'dr. azriel, Sp.PD',
                'spesialisasi' => 'Penyakit Dalam',
            ],
            [
                'nama' => 'dr. siti, Sp.JP',
                'spesialisasi' => 'Jantung',
            ],
        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}