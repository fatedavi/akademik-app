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
        $tingkats = Tingkat::all();    // e.g., X, XI, XII
        $jurusans = Jurusan::all();    // e.g., RPL, TKJ, dsb.

        foreach ($tingkats as $tingkat) {
            foreach ($jurusans as $jurusan) {
                for ($i = 1; $i <= 2; $i++) {
                    Kelas::create([
                        'tingkat_id' => $tingkat->id,
                        'jurusan_id' => $jurusan->id,
                        'nama' => 'Kelas ' . $i
                    ]);
                }
            }
        }
    }
}
