<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Tampilkan semua kelas
    public function index()
    {
        $kelasList = Kelas::with(['tingkat', 'jurusan'])->get();
        return view('kelas.index', compact('kelasList'));
    }

    // Form tambah kelas
    public function create()
    {
        $tingkats = Tingkat::all();
        $jurusans = Jurusan::all();
        return view('kelas.create', compact('tingkats', 'jurusans'));
    }

    // Simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'tingkat_id' => 'required|exists:tingkats,id',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    // Form edit kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $tingkats = Tingkat::all();
        $jurusans = Jurusan::all();

        return view('kelas.edit', compact('kelas', 'tingkats', 'jurusans'));
    }



    // Simpan perubahan kelas
    public function update(Request $request, $id)
{
    $kelas = Kelas::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'tingkat_id' => 'required|integer',
        'jurusan_id' => 'required|integer',
    ]);

    $kelas->update([
        'nama' => $request->nama,
        'tingkat_id' => $request->tingkat_id,
        'jurusan_id' => $request->jurusan_id,
    ]);

    return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate.');
}


    // Hapus kelas
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
