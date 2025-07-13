<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa; // Pastikan model Siswa sudah ada
use App\Models\Kelas; // Pastikan model Kelas sudah ada
use App\Models\User; // Pastikan model User sudah ada
use App\Models\Guru; // Pastikan model Guru sudah ada

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }
    public function create(Request $request)
    {
        $search = $request->query('search');
        
        $users = User::doesntHave('guru')
    ->where('role', 'guru')
    ->get();



        $gurus = \App\Models\Guru::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })->get();

        return view('admin.addguru', compact('users', 'gurus', 'search'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'user_id' => 'required|exists:users,id|unique:gurus,user_id',
            'alamat' => 'nullable|string',
            'nomor_handphone' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Guru::create($data);
        return redirect()->route('guru.create')->with('success', 'Data guru ditambahkan');
    }
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.create')->with('success', 'Data guru berhasil dihapus');
    }

}
