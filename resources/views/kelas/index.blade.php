@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Kelas</h2>
            <a href="{{ route('kelas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Kelas
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Tingkat</th>
                    <th class="border p-2">Jurusan</th>
                    <th class="border p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelasList as $kelas)
                    <tr>
                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $kelas->nama }}</td>
                        <td class="border p-2">{{ $kelas->tingkat->nama ?? '-' }}</td>
                        <td class="border p-2">{{ $kelas->jurusan->nama ?? '-' }}</td>
                        <td class="border p-2 text-center space-x-2">
                            <a href="{{ route('kelas.edit', $kelas) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('kelas.destroy', $kelas) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-600">Belum ada data kelas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
