<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;

use App\Models\Berita;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $beritas = [
            (object)[
                'id' => 1,
                'judul' => 'Lomba Futsal Antar Kelas',
                'kategori' => 'Olahraga',
                'tanggal' => Carbon::parse('2025-06-20'),
                'gambar' => asset('images/futsal.jpg'),
                'konten' => 'Pertandingan futsal antar kelas berlangsung seru dan meriah di lapangan sekolah.'
            ],
            (object)[
                'id' => 2,
                'judul' => 'Sosialisasi PKL 2025',
                'kategori' => 'Informasi',
                'tanggal' => Carbon::parse('2025-06-18'),
                'gambar' => asset('images/pkl.jpg'),
                'konten' => 'Sosialisasi PKL diadakan untuk memberikan informasi kepada siswa kelas XI mengenai magang industri.'
            ],
            (object)[
                'id' => 3,
                'judul' => 'Kunjungan Industri ke PT. XYZ',
                'kategori' => 'Kegiatan',
                'tanggal' => Carbon::parse('2025-06-15'),
                'gambar' => asset('images/kunjungan.jpg'),
                'konten' => 'Siswa jurusan RPL mengunjungi PT. XYZ untuk mengenal dunia kerja secara langsung.'
            ]
        ];

        return view('landing', compact('beritas', 'jumlahSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
