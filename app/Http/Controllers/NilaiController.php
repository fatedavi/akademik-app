<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('nilai.index', compact('siswas'));
    }


    public function create()
    {
        $siswas = Siswa::all(); // Ambil semua siswa
        return view('nilai.create', compact('siswas'));
    }



   public function store(Request $request)
{
    $validated = $request->validate([
        'siswa_id' => 'required|exists:siswas,id',
        'mata_pelajaran' => 'required|string|max:255',
        'nilai' => 'required|integer|min:0|max:100',
    ]);

    \App\Models\Nilai::create($validated);

    return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
}

    public function show(string $id)
    {
        $nilai = Nilai::with('siswa')->findOrFail($id);
        return view('nilai.show', compact('nilai'));
    }

    public function edit(string $id)
    {
        $nilai = Nilai::findOrFail($id);
        $siswas = Siswa::all();
        return view('nilai.edit', compact('nilai', 'siswas'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mata_pelajaran' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($validated);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
