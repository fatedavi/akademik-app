@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Input Data Siswa</h2>

    {{-- Pesan sukses atau error --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($sudahInput && $siswa)
        <div class="bg-green-50 border border-green-300 text-green-800 p-4 rounded shadow mb-6">
            <p class="font-semibold mb-2">Data Anda:</p>
            <ul class="text-sm space-y-1">
                <li><strong>Nama:</strong> {{ $siswa->nama }}</li>
                <li><strong>Kelas:</strong> {{ $siswa->kelas->nama ?? '-' }}</li>
                <li><strong>Tingkat:</strong> {{ $siswa->kelas->tingkat->nama ?? '-' }}</li>
                <li><strong>Jurusan:</strong> {{ $siswa->kelas->jurusan->nama ?? '-' }}</li>
                <li><strong>Alamat:</strong> {{ $siswa->alamat }}</li>
                <li><strong>No HP:</strong> {{ $siswa->nomor_handphone }}</li>
                <li><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</li>
                <li><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</li>
            </ul>
            <div class="mt-4 text-sm text-gray-600">
                Pengisian hanya dapat dilakukan satu kali. Hubungi admin atau guru untuk perubahan data.
            </div>
        </div>
    @else
        <form action="{{ route('siswa.store') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin data yang dimasukkan sudah benar?')">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block font-medium text-sm text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Kelas --}}
            <div class="mb-4">
                <label for="kelas_id" class="block font-medium text-sm text-gray-700">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama }} - {{ $kelas->tingkat->nama ?? 'Tingkat?' }} - {{ $kelas->jurusan->nama ?? 'Jurusan?' }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nomor_handphone" class="block font-medium text-sm text-gray-700">Nomor Handphone</label>
                <input type="text" name="nomor_handphone" id="nomor_handphone" value="{{ old('nomor_handphone') }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('nomor_handphone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block font-medium text-sm text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('tanggal_lahir')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded shadow">
                    Simpan Data
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
