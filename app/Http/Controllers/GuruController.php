<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa; // Pastikan model Siswa sudah ada

class GuruController extends Controller
{
    public function index()
    {
    // if (auth()->user()->role !== 'guru') {
    //     abort(403, 'Hanya guru yang bisa mengakses halaman ini.');
    // }
        return view('guru.index');
    }
    public function create()
    {
        $siswas = Siswa::all();
        return view('guru.addSiswa', compact('siswas'));
    }
}
