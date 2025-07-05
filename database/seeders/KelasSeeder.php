<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Jurusan;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada data tingkat dan jurusan dulu
        $tingkat10 = Tingkat::firstOrCreate(['nama' => 'X']);
        $tingkat11 = Tingkat::firstOrCreate(['nama' => 'XI']);
        $tingkat12 = Tingkat::firstOrCreate(['nama' => 'XII']);

        $rpl = Jurusan::firstOrCreate(['nama' => 'Rekayasa Perangkat Lunak']);
        $tkj = Jurusan::firstOrCreate(['nama' => 'Teknik Komputer dan Jaringan']);

        // Tambahkan kelas
        $dataKelas = [
            ['nama' => 'X RPL 1', 'tingkat_id' => $tingkat10->id, 'jurusan_id' => $rpl->id],
            ['nama' => 'X TKJ 1', 'tingkat_id' => $tingkat10->id, 'jurusan_id' => $tkj->id],
            ['nama' => 'XI RPL 2', 'tingkat_id' => $tingkat11->id, 'jurusan_id' => $rpl->id],
            ['nama' => 'XII TKJ 1', 'tingkat_id' => $tingkat12->id, 'jurusan_id' => $tkj->id],
        ];

        foreach ($dataKelas as $kelas) {
            Kelas::updateOrCreate(
                ['nama' => $kelas['nama']],
                ['tingkat_id' => $kelas['tingkat_id'], 'jurusan_id' => $kelas['jurusan_id']]
            );
        }
    }
}
