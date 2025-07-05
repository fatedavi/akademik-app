@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="bg-blue-100 py-20">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 items-center gap-8">
            <!-- Kiri: Teks -->
            <div>
                <h2 class="text-4xl font-bold mb-4">Selamat Datang di Sistem Akademik SMK</h2>
                <p class="text-lg text-gray-700 mb-6">
                    Mudah kelola data siswa, guru, dan nilai dalam satu sistem terpadu.
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800 transition">
                    Lihat Fitur
                </a>
            </div>

            <!-- Kanan: Gambar -->
            <div class="text-center">
                <img src="{{ asset('images/sekola.jpg') }}"" alt="Ilustrasi Sekolah" class="w-full h-auto rounded-lg shadow-md">
            </div>
        </div>
    </div>
</section>

<!-- Tentang -->
<section id="tentang" class="py-16">
    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-semibold text-center mb-6">Tentang Aplikasi</h3>
        <p class="max-w-3xl mx-auto text-center text-gray-600">
            Sistem ini dirancang untuk membantu pengelolaan administrasi sekolah seperti data siswa, guru, mata pelajaran, dan penilaian.
        </p>
    </div>
</section>

<!-- Fitur -->
<section id="fitur" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-semibold text-center mb-8">Fitur Utama</h3>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded p-6 text-center">
                <h4 class="font-bold text-xl mb-2">Data Siswa</h4>
                <p>CRUD data siswa lengkap dengan pencarian dan filter.</p>
                  <div class="mt-4">
        <span class="text-lg font-semibold">Jumlah Siswa: {{ $jumlahSiswa }}</span>
    </div>
            </div>
            <div class="bg-white shadow rounded p-6 text-center">
                <h4 class="font-bold text-xl mb-2">Data Guru</h4>
                <p>Kelola informasi guru dengan mudah dan cepat.</p>
            </div>
            <div class="bg-white shadow rounded p-6 text-center">
                <h4 class="font-bold text-xl mb-2">Nilai</h4>
                <p>Input dan lihat nilai siswa sesuai kelas dan mata pelajaran.</p>
            </div>
        </div>
    </div>
</section>
<!-- Berita -->
<!-- Berita -->
<section id="berita" class="py-16 bg-white" x-data="{ modalOpen: false, selectedBerita: {} }">

    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-semibold text-center mb-10">Ragam Berita Sekolah</h3>

       <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
    @foreach ($beritas as $berita)
        <div
            @click="selectedBerita = {{ Js::from($berita) }}; modalOpen = true"
            class="relative rounded-xl overflow-hidden shadow-lg group h-64 cursor-pointer"
        >
            <div class="absolute inset-0 bg-cover bg-center transition-transform group-hover:scale-105"
                 style="background-image: url('{{ $berita->gambar }}');"></div>
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute bottom-0 p-4 text-white z-10">
                <h4 class="text-xl font-bold">{{ $berita->judul }}</h4>
                <p class="text-sm opacity-80">{{ $berita->kategori }} • {{ $berita->tanggal->format('d M Y') }}</p>
            </div>
        </div>
    @endforeach
</div>

     <!-- Modal -->
<div
    x-show="modalOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-200"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
>
    <div
        x-show="modalOpen"
        @click.outside="modalOpen = false"
        x-transition:enter="transition transform ease-out duration-300"
        x-transition:leave="transition transform ease-in duration-200"
        class="bg-white w-full max-w-lg p-6 rounded-lg shadow-xl relative"
    >
        <button @click="modalOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl">&times;</button>
        <div>
            <h2 class="text-2xl font-bold mb-2" x-text="selectedBerita.judul"></h2>
            <p class="text-sm text-gray-500 mb-4" x-text="`${selectedBerita.kategori} • ${new Date(selectedBerita.tanggal).toLocaleDateString()}`"></p>
            <img :src="selectedBerita.gambar" alt="" class="w-full h-48 object-cover rounded mb-4">
            <p class="text-gray-700" x-text="selectedBerita.konten"></p>
        </div>
    </div>
</div>

</section>


<!-- Kontak -->
<section id="kontak" class="py-16">
    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-semibold text-center mb-6">Hubungi Kami</h3>
        <p class="text-center text-gray-600">Jl. Pendidikan No. 123, Email: info@smk-akademik.sch.id</p>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#beritaTable').DataTable();
    });
</script>
@endpush
