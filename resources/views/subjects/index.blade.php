@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Mata Pelajaran</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('subjects.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Tambah Mata Pelajaran</a>

    <table class="w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Guru</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $subject->name }}</td>
                    <td class="border p-2">{{ $subject->guru->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center text-gray-500">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
