<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tingkat;

class TingkatSeeder extends Seeder
{
    public function run(): void
    {
        $tingkats = ['X', 'XI', 'XII'];
        foreach ($tingkats as $nama) {
            Tingkat::create(['nama' => $nama]);
        }
    }
}
