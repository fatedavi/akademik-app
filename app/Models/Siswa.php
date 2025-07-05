<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // pastikan ini ada

    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'kelas_id',
        'nomor_handphone',
        'jenis_kelamin',
        'tanggal_lahir',
    ];
        public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class);
    }


}
