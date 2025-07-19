@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Siswa</h1>
    </div>

    <!-- Flash message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Kelas -->
    <form method="GET" class="mb-4 flex items-center gap-2">
        <select name="kelas_id" class="border px-3 py-2 rounded w-1/3">
            <option value="">-- Semua Kelas --</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->tingkat->nama ?? '?' }} {{ $kelas->jurusan->nama ?? '?' }} - {{ $kelas->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        @if (request('kelas_id'))
            <a href="{{ route('guru.list-siswa') }}" class="text-sm text-red-500 hover:underline ml-2">Reset</a>
        @endif
    </form>

    <!-- Nama Kelas yang Ditampilkan -->
    @if ($kelasId)
        @php
            $kelasDipilih = $kelasList->firstWhere('id', $kelasId);
        @endphp
        <h2 class="text-lg font-semibold mb-4">
            Menampilkan siswa dari kelas:
            <span class="text-blue-600">
                {{ $kelasDipilih->tingkat->nama ?? '?' }} {{ $kelasDipilih->jurusan->nama ?? '?' }} - {{ $kelasDipilih->nama }}
            </span>
        </h2>
    @endif

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
            </tr>
        </thead>
        <tbody>
            @forelse ($siswas as $siswa)
                <tr>
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $siswa->nama }}</td>
                    <td class="border p-2">{{ $siswa->alamat }}</td>
                    <td class="border p-2">{{ $siswa->jenis_kelamin }}</td>
                    <td class="border p-2">{{ $siswa->kelas->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->kelas->tingkat->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->kelas->jurusan->nama ?? '-' }}</td>
                    <td class="border p-2">{{ $siswa->nomor_handphone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="border p-2 text-center text-gray-500">Tidak ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
