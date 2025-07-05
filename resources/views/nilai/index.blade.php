@extends('layouts.app')

@section('content')
<form action="{{ route('nilai.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="siswa_id" class="block font-semibold">Pilih Siswa</label>
        <select name="siswa_id" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswas as $s)
                <option value="{{ $s->id }}">{{ $s->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="mata_pelajaran" class="block font-semibold">Mata Pelajaran</label>
        <input type="text" name="mata_pelajaran" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label for="nilai" class="block font-semibold">Nilai</label>
        <input type="number" name="nilai" class="w-full border p-2 rounded" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

@endsection
