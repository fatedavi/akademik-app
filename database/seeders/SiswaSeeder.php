<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user siswa terlebih dahulu
        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => "Siswa $i",
                'email' => "siswa$i@example.com",
                'password' => Hash::make('password'), // default password
            ]);

            // Ambil salah satu kelas acak
            $kelas = Kelas::inRandomOrder()->first();

            // Tambahkan data siswa
            Siswa::create([
                'nama' => $user->name,
                'user_id' => $user->id,
                'alamat' => "Jl. Contoh No.$i",
                'kelas_id' => $kelas?->id, // nullable
                'nomor_handphone' => '08123456789' . $i,
                'jenis_kelamin' => $i % 2 === 0 ? 'L' : 'P',
                'tanggal_lahir' => now()->subYears(17)->subDays($i),
            ]);
        }
    }
}
