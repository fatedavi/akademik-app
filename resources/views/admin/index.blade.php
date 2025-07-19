@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">
            Selamat datang, {{ Auth::user()->name }}
        </h1>

        <p class="text-gray-700 mb-6">
            Anda login sebagai <strong>Admin</strong>. Berikut beberapa menu yang bisa Anda akses:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Verifikasi Guru -->

            <!-- Tambah Guru -->
            <a href="{{ route('guru.create') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-4 rounded shadow text-center">
                <h3 class="font-semibold text-lg mb-2">Tambah Data Guru</h3>
                <p class="text-sm">Tambahkan guru baru ke sistem.</p>
            </a>

            <!-- Nilai Siswa -->
            <a href="{{ route('nilai.index') }}" class="bg-green-100 hover:bg-green-200 text-green-800 p-4 rounded shadow text-center">
                <h3 class="font-semibold text-lg mb-2">Nilai Siswa</h3>
                <p class="text-sm">Tambah atau ubah nilai siswa.</p>
            </a>

            <!-- Mata Pelajaran -->
            <a href="{{ route('subjects.index') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 p-4 rounded shadow text-center">
                <h3 class="font-semibold text-lg mb-2">Mata Pelajaran</h3>
                <p class="text-sm">Manajemen mata pelajaran.</p>
            </a>

            <!-- Data Siswa -->
            <a href="{{ route('siswa.addSiswa') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-4 rounded shadow text-center">
                <h3 class="font-semibold text-lg mb-2">Manajemen Data Siswa</h3>
                <p class="text-sm">Menambahkan, mengedit, dan menghapus data siswa.</p>
            </a>

            <!-- Set Kelas -->
            <a href="{{ route('kelas.index') }}" class="bg-purple-100 hover:bg-purple-200 text-purple-800 p-4 rounded shadow text-center">
                <h3 class="font-semibold text-lg mb-2">Manajemen Kelas</h3>
                <p class="text-sm">Atur dan kelola kelas, jurusan, dan tingkat.</p>
            </a>
        </div>
    </div>
</div>
@endsection
