<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    public function run()
    {
        $pasiens = [
            [
                'nama' => 'Anton Pratama',
                'kontak' => '081234567890',
                'email' => 'anton@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama' => 'Budi Setiawan',
                'kontak' => '085678901234',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'nama' => 'Cindy Aulia',
                'kontak' => '087890123456',
                'email' => 'cindy@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}