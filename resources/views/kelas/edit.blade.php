@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        <h2 class="text-xl font-bold mb-4">Edit Kelas</h2>

        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">

            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama Kelas</label>
                <input type="text" name="nama" class="w-full border px-3 py-2 rounded" value="{{ $kelas->nama }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Tingkat</label>
                <select name="tingkat_id" class="w-full border px-3 py-2 rounded" required>
                    @foreach ($tingkats as $tingkat)
                        <option value="{{ $tingkat->id }}" {{ $kelas->tingkat_id == $tingkat->id ? 'selected' : '' }}>
                            {{ $tingkat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Jurusan</label>
                <select name="jurusan_id" class="w-full border px-3 py-2 rounded" required>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ $kelas->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('kelas.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
