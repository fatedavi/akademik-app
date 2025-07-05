<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkat';
    protected $fillable = ['nama'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
