<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Subject;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class NilaiController extends Controller
{
public function index(Request $request)
{
    // Ambil daftar jurusan (dropdown filter)
    $daftarJurusan = Jurusan::pluck('nama', 'id');

    // Ambil kelas berdasarkan filter jurusan
    $kelasQuery = Kelas::with('jurusan')->withCount('siswa');

    if ($request->filled('jurusan_id')) {
        $kelasQuery->where('jurusan_id', $request->jurusan_id);
    }

    $kelasList = $kelasQuery->get();

    // Jika kelas dipilih, ambil siswa-nya
    $siswaList = collect();
    $namaKelasDipilih = '';

    if ($request->filled('kelas_id')) {
        $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
        $namaKelasDipilih = Kelas::find($request->kelas_id)?->nama ?? '';
    }

    return view('nilai.index', compact('daftarJurusan', 'kelasList', 'siswaList', 'namaKelasDipilih'));
}

public function nilaiBySiswa($id)
{
    $nilaiList = Nilai::where('siswa_id', $id)->with('subject')->get();
    return view('nilai._nilai_modal', compact('nilaiList'));
}
public function create(Request $request)
{
    $kelasId = $request->kelas_id;
    $kelas = Kelas::with('siswa')->findOrFail($kelasId);

    $subjects = Subject::all(); // misal ingin isi nilai berdasarkan mapel

    return view('nilai.create', [
        'kelas' => $kelas,
        'siswaList' => $kelas->siswa,
        'subjects' => $subjects,
    ]);
}
public function listSiswa($kelasId)
{
    $kelas = Kelas::findOrFail($kelasId); // <-- pastikan ada baris ini
    $siswaList = $kelas->siswa; // atau sesuaikan relasi dengan kelas
    $subjectList = Subject::all();

    return view('nilai.list-siswa', compact('kelas', 'siswaList', 'subjectList'));
}


public function store(Request $request)
{
    $data = $request->input('nilai', []);

    foreach ($data as $siswaId => $nilaiData) {
        // Validasi nilai & subject
        if (!empty($nilaiData['nilai']) && !empty($nilaiData['subject_id'])) {

            // Cek apakah sudah ada nilai untuk siswa dan subject ini
            $existing = Nilai::where('siswa_id', $siswaId)
                ->where('subject_id', $nilaiData['subject_id'])
                ->first();

            if (!$existing) {
                // Jika belum ada, baru buat
                Nilai::create([
                    'siswa_id' => $siswaId,
                    'subject_id' => $nilaiData['subject_id'],
                    'nilai' => $nilaiData['nilai'],
                ]);
            } else {
                // Bisa juga update, atau skip saja
                // $existing->update(['nilai' => $nilaiData['nilai']]);
            }
        }
    }

    return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan.');
}



    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $siswas = Siswa::all();
        $subjects = Subject::all();
        return view('nilai.edit', compact('nilai', 'siswas', 'subjects'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'subject_id' => 'required|exists:subjects,id',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($request->all());

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
