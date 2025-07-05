<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'tingkat_id',
        'jurusan_id',
    ];

    /**
     * Relasi ke model Tingkat
     */
    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    /**
     * Relasi ke model Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relasi ke siswa-siswa di kelas ini
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
