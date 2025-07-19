
{{-- resources/views/nilai/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        <h2 class="text-xl font-bold mb-4">Edit Nilai</h2>

        <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Siswa</label>
                <select name="siswa_id" class="w-full border px-3 py-2 rounded" required>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}" {{ $nilai->siswa_id == $siswa->id ? 'selected' : '' }}>
                            {{ $siswa->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Mata Pelajaran</label>
                <select name="subject_id" class="w-full border px-3 py-2 rounded" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $nilai->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nilai</label>
                <input type="number" name="nilai" value="{{ $nilai->nilai }}" class="w-full border px-3 py-2 rounded" min="0" max="100" required>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('nilai.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
