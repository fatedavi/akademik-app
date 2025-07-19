<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            'Rekayasa Perangkat Lunak (RPL)',
            'Teknik Komputer dan Jaringan (TKJ)',
            'Akuntansi dan Keuangan Lembaga (AKL)',
            'Bisnis Daring dan Pemasaran (BDP)',
            'Otomatisasi dan Tata Kelola Perkantoran (OTKP)',
            'Teknik Kendaraan Ringan Otomotif (TKRO)',
            'Teknik dan Bisnis Sepeda Motor (TBSM)',
        ];

        foreach ($jurusans as $nama) {
            Jurusan::create(['nama' => $nama]);
        }
    }
}
