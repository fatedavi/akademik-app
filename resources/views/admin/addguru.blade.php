@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="{ open: false, editModal: null }">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Guru</h1>
        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Guru
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <form method="GET" class="flex items-center gap-2 mb-4">
        <input type="text" name="search" placeholder="Cari nama guru..." value="{{ request('search') }}" class="border px-3 py-2 rounded w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cari</button>
        @if (request('search'))
            <a href="{{ url()->current() }}" class="text-sm text-red-500 hover:underline ml-2">Reset</a>
        @endif
    </form>

    <!-- Tabel guru -->
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Alamat</th>
                <th class="border p-2">Jenis Kelamin</th>
                <th class="border p-2">Tanggal Lahir</th>
                <th class="border p-2">No. HP</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gurus as $guru)
                <tr>
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $guru->nama }}</td>
                    <td class="border p-2">{{ $guru->alamat ?? '-' }}</td>
                    <td class="border p-2">{{ $guru->jenis_kelamin }}</td>
                    <td class="border p-2">{{ $guru->tanggal_lahir ?? '-' }}</td>
                    <td class="border p-2">{{ $guru->nomor_handphone ?? '-' }}</td>
                    <td class="border p-2 text-center space-x-2">
                        <button @click="editModal = {{ $guru->id }}" class="text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('guru.destroy', $guru) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Guru -->
                <div x-show="editModal === {{ $guru->id }}" x-transition class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative">
                        <h2 class="text-xl font-bold mb-4">Edit Guru</h2>
                        <form action="{{ route('guru.update', $guru) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Nama</label>
                                <input type="text" name="nama" value="{{ $guru->nama }}" class="w-full border px-3 py-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Alamat</label>
                                <input type="text" name="alamat" value="{{ $guru->alamat }}" class="w-full border px-3 py-2 rounded">
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Nomor HP</label>
                                <input type="text" name="nomor_handphone" value="{{ $guru->nomor_handphone }}" class="w-full border px-3 py-2 rounded">
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                                    <option value="L" {{ $guru->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $guru->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}" class="w-full border px-3 py-2 rounded">
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

    <!-- Modal Tambah Guru -->
    <div x-show="open" x-transition class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl relative">
            <h2 class="text-xl font-bold mb-4">Tambah Guru</h2>
            <form action="{{ route('guru.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Alamat</label>
                    <input type="text" name="alamat" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nomor HP</label>
                    <input type="text" name="nomor_handphone" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">User Guru</label>
                    <select name="user_id" required class="w-full border px-3 py-2 rounded" id="select-user">
                        <option value="">-- Pilih User Guru --</option>
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
@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        new TomSelect("#select-user", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            placeholder: "Cari dan pilih user guru..."
        });
    });
</script>
@endpush
