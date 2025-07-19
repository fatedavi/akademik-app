<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
 
    use HasFactory;

    protected $table = 'nilai'; // pastikan ini ada
    
    protected $fillable = [
        'siswa_id',
        'subject_id',
        'nilai',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
