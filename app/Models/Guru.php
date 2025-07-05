<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $table = 'guru'; // pastikan ini ada

    protected $fillable = [
        'nama',
        'alamat',
        'nomor_handphone',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
