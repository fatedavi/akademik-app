@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="{ open: false, editModal: null }">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Siswa</h1>
        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Siswa
        </button>
    </div>

    <!-- Flash message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <form method="GET" class="flex items-center gap-2 mb-4">
        <input
            type="text"
            name="search"
            placeholder="Cari nama siswa..."
            value="{{ request('search') }}"
            class="border px-3 py-2 rounded w-1/3"
        >
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cari</button>
    @if (request('search'))
    <a href="{{ url()->current() }}" class="text-sm text-red-500 hover:underline ml-2">Reset</a>
@endif

    </form>

    <!-- Tabel siswa -->
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Alamat</th>
                <th class="border p-2">Jenis Kelamin</th>
                <th class="border p-2">Kelas</th>
                <th class="border p-2">Tingkat</th>
                <th class="border p-2">Jurusan</th>
                <th class="border p-2">No. HP</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $siswa)
                <tr>
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $siswa->nama }}</td>
                    <td class="border p-2">{{ $siswa->alamat }}</td>
                    <td class="border p-2">{{ $siswa->jenis_kelamin }}</td>
                    <td class="border p-2">{{ $siswa->kelas->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->kelas->tingkat->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->kelas->jurusan->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->nomor_handphone }}</td>
                    <td class="border p-2 space-x-2 text-center">
                        <button
                            @click="editModal = {{ $siswa->id }}"
                            class="text-blue-600 hover:underline"
                        >Edit</button>

                        <form
                            action="{{ route('siswa.destroy', $siswa) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div
                    x-show="editModal === {{ $siswa->id }}"
                    x-transition
                    class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50"
                >
                    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative">
                        <h2 class="text-xl font-bold mb-4">Edit Siswa</h2>
                        <form action="{{ route('siswa.update', $siswa) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Nama</label>
                                <input type="text" name="nama" value="{{ $siswa->nama }}" class="w-full border px-3 py-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">NIS</label>
                                <input type="text" name="nis" value="{{ $siswa->nis }}" class="w-full border px-3 py-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Alamat</label>
                                <input type="text" name="alamat" value="{{ $siswa->alamat }}" class="w-full border px-3 py-2 rounded">
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                                    <option value="L" {{ $siswa->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $siswa->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Kelas</label>
                                <select name="kelas_id" class="w-full border px-3 py-2 rounded" required>
                                    @foreach ($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}"
                                            {{ $siswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->tingkat->nama ?? '?' }} {{ $kelas->jurusan->nama ?? '?' }} - {{ $kelas->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">No. HP</label>
                                <input type="text" name="nomor_handphone" value="{{ $siswa->nomor_handphone }}" class="w-full border px-3 py-2 rounded">
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" @click="editModal = null" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                            </div>
                        </form>
                        <button @click="editModal = null" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">&times;</button>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Siswa -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative">
            <h2 class="text-xl font-bold mb-4">Tambah Siswa</h2>
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">NIS</label>
                    <input type="text" name="nis" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Alamat</label>
                    <input type="text" name="alamat" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Kelas</label>
                    <select name="kelas_id" class="w-full border px-3 py-2 rounded" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas->id }}">
                                {{ $kelas->tingkat->nama ?? '?' }} {{ $kelas->jurusan->nama ?? '?' }} - {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">No. HP</label>
                    <input type="text" name="nomor_handphone" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">User Siswa</label>
                    <select name="user_id" required class="w-full border px-3 py-2 rounded">
                        <option value="">-- Pilih User Siswa --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
            <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">&times;</button>
        </div>
    </div>
</div>
@endsection
