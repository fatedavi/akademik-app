@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="{ open: false, editModal: null }">
    <!-- Header & tombol tambah -->
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

    <!-- Tabel data -->
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>

                <th class="border p-2">Alamat</th>
                <th class="border p-2">Jenis Kelamin</th>
                <th class="border p-2">Kelas</th>
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
                <td class="border p-2">{{ $siswa->kelas }}</td>
                <td class="border p-2">{{ $siswa->nomor_handphone }}</td>
                <td class="border p-2 space-x-2">
                    <!-- Tombol Edit -->
                    <button
                        @click="editModal = {{ $siswa->id }}"
                        class="text-blue-600 hover:underline"
                    >Edit</button>

                    <!-- Tombol Hapus -->
                    <form
                        action="{{ route('siswa.destroy', $siswa) }}"
                        method="POST"
                        class="inline"
                        onsubmit="return confirm('Hapus data ini?')"
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
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50"
            >
                <div
                    x-transition:enter="transition transform ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition transform ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative"
                >
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
                            <input type="text" name="jenis_kelamin" value="{{ $siswa->jenis_kelamin }}" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Kelas</label>
                            <input type="text" name="kelas" value="{{ $siswa->kelas }}" class="w-full border px-3 py-2 rounded" required>
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
                    <button @click="editModal = null" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50"
    >
        <div
            x-transition:enter="transition transform ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative"
        >
            <h2 class="text-xl font-bold mb-4">Tambah Siswa</h2>
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block mb-1 font-semibold">Nama</label>
                    <input type="text" id="nama" name="nama" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="nis" class="block mb-1 font-semibold">NIS</label>
                    <input type="text" id="nis" name="nis" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block mb-1 font-semibold">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="jenis_kelamin" class="block mb-1 font-semibold">Jenis Kelamin</label>
                    <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="kelas" class="block mb-1 font-semibold">Kelas</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="nomor_handphone" class="block mb-1 font-semibold">No. HP</label>
                    <input type="text" id="nomor_handphone" name="nomor_handphone" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
        </div>
    </div>
</div>
@endsection
