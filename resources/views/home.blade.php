@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Kartu 1 -->
       @php
    $isSiswa = Auth::user()->role === 'siswa';
    $isGuru = Auth::user()->role === 'guru';
    $isAdmin = Auth::user()->role === 'admin';
    $isSuperAdmin = Auth::user()->role === 'super_admin';
@endphp

@if ($isSiswa)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <div class="bg-blue-600 h-24 p-4 text-white flex items-center justify-between">
            <h2 class="text-xl font-semibold">
                {{ $sudahInput ? 'Sudah Melengkapi Data' : 'Lengkapi Data Siswa' }}
            </h2>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4v16m8-8H4" />
            </svg>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mb-4">
                {{ $sudahInput ? 'Lihat Data Kamu!' : 'Anda belum melengkapi data siswa.' }}
            </p>

            <a href="{{ route('siswa.index') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ $sudahInput ? 'Lihat Data' : 'Lengkapi Sekarang' }}
            </a>
        </div>
    </div>
@endif
@if ($isGuru)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <div class="bg-orange-600 h-24 p-4 text-white flex items-center justify-between">
            <h2 class="text-xl font-semibold">Kelola Data Siswa</h2>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17v-2a4 4 0 014-4h6M9 17H5a2 2 0 01-2-2v-1a4 4 0 014-4h1m4 0V5a2 2 0 012-2h4a2 2 0 012 2v10" />
            </svg>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mb-4">Lihat dan kelola semua data siswa.</p>
            <a href="{{ route('guru.dashboard') }}"
               class="inline-block px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
                Kelola Sekarang
            </a>
        </div>
    </div>
@endif
@if ($isAdmin)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <div class="bg-green-600 h-24 p-4 text-white flex items-center justify-between">
            <h2 class="text-xl font-semibold">Manajemen Sistem</h2>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10h11M9 21V3m0 0L4 8m5-5l5 5" />
            </svg>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mb-4">Kelola data guru, siswa, kelas, jurusan, dan mata pelajaran.</p>
            <a href="{{ route('admin.index') }}"
               class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Buka Panel Admin
            </a>
        </div>
    </div>
@endif
@if ($isSuperAdmin)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <div class="bg-green-600 h-24 p-4 text-white flex items-center justify-between">
            <h2 class="text-xl font-semibold">Manajemen Sistem SuperAdmin</h2>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10h11M9 21V3m0 0L4 8m5-5l5 5" />
            </svg>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mb-4">Kelola data guru, admin, siswa, kelas, jurusan, dan mata pelajaran.</p>
            <a href="{{ route('superadmin.index') }}"
               class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Buka Panel Admin
            </a>
        </div>
    </div>
@endif


        <!-- Kartu 2 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-green-600 h-24 p-4 text-white flex items-center justify-between">
                <h2 class="text-xl font-semibold">Verifikasi Email</h2>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 12H8m8 0H8m8 0H8" />
                </svg>
            </div>
            <div class="p-4">
                <p class="text-gray-700 mb-4">Status verifikasi email Anda.</p>
                @if (Auth::user()->hasVerifiedEmail())
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded text-sm">Terverifikasi</span>
                @else
                    <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded text-sm">Belum Diverifikasi</span>
                    <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="text-sm text-blue-600 hover:underline">Kirim Ulang Email Verifikasi</button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Kartu 3 (opsional) -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-purple-600 h-24 p-4 text-white flex items-center justify-between">
                <h2 class="text-xl font-semibold">Akun Saya</h2>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A3.001 3.001 0 007 20h10a3.001 3.001 0 001.879-5.196M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="p-4">
                <p class="text-gray-700 mb-4">Lihat dan kelola informasi akun Anda.</p>
                <a href="#"
                   class="inline-block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                    Kelola Akun
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
