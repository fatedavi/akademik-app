<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    
    public function index()
    {
        if (!auth()->user() || !auth()->user()->hasVerifiedEmail()) {
            abort(403, 'Akun Anda belum diverifikasi.');
        }

        $user = auth()->user();
        $siswa = Siswa::where('user_id', $user->id)->first();
        $sudahInput = $siswa !== null;

        $siswas = Siswa::all();
        $kelasList = \App\Models\Kelas::with('jurusan', 'tingkat')->get();

        return view('siswa.index', compact('siswa', 'sudahInput', 'siswas', 'kelasList'));
    }
    public function create(Request $request)
    {
        if (!auth()->user() || !auth()->user()->hasVerifiedEmail()) {
            abort(403, 'Akun Anda belum diverifikasi.');
        }

        $search = $request->query('search');

        $siswas = Siswa::with('kelas.tingkat', 'kelas.jurusan')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->get();

        $kelasList = Kelas::with('tingkat', 'jurusan')->get();

        // INI TAMBAHANNYA: ambil user yang belum punya siswa
        $users = User::doesntHave('siswa')->where('role', 'siswa')->get();

        // Pastikan $users dikirim ke view
        return view('guru.addSiswa', compact('siswas', 'kelasList', 'search', 'users'));
    }


    public function store(Request $request)
    {
        // Cek jika siswa sudah pernah input
        if (auth()->user()->role === 'siswa' && Siswa::where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'Kamu hanya bisa mengisi data sekali.');
        }
        $users = User::doesntHave('siswa')->where('role', 'siswa')->get(); // misalnya ada kolom 'role'

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|string|max:255',
            'nomor_handphone' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

   public function update(Request $request, Siswa $siswa)
{
    if (auth()->user()->role === 'siswa') {
        abort(403, 'Akses ditolak.');
    }
    $users = User::doesntHave('siswa')->where('role', 'siswa')->get(); // misalnya ada kolom 'role'

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id|unique:siswa,user_id,' . $siswa->id,
        'kelas_id' => 'required|exists:kelas,id',
        'alamat' => 'nullable|string|max:255',
        'nomor_handphone' => 'nullable|string|max:20',
        'jenis_kelamin' => 'nullable|in:L,P',
        'tanggal_lahir' => 'nullable|date',
    ]);

    $siswa->update($validated);

    return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }
    
        public function edit(Siswa $siswa)
    {
        $kelasList = Kelas::with('tingkat', 'jurusan')->get();
        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    public function destroy(Siswa $siswa)
    {
        if (auth()->user()->role === 'siswa') {
            abort(403, 'Akses ditolak.');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
    public function countSiswa(): int
    {
        return Siswa::count();
    }
}
