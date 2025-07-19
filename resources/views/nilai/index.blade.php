@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Manajemen Nilai</h1>

        {{-- Filter Jurusan --}}
        <form method="GET" class="mb-4 flex items-center gap-4">
            <label for="jurusan_id" class="font-medium">Filter Jurusan:</label>
            <select name="jurusan_id" id="jurusan_id" class="border p-2 rounded" onchange="this.form.submit()">
                <option value="">Semua Jurusan</option>
                @foreach($daftarJurusan as $id => $nama)
                    <option value="{{ $id }}" {{ request('jurusan_id') == $id ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Tabel Kelas --}}
        <h2 class="text-xl font-semibold mb-2">Daftar Kelas</h2>
        <table class="w-full border mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Nama Kelas</th>
                    <th class="border p-2">Jurusan</th>
                    <th class="border p-2">Jumlah Siswa</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelasList as $kelas)
                    <tr>
                        <td class="border p-2">{{ $kelas->nama }}</td>
                        <td class="border p-2">{{ $kelas->jurusan->nama ?? '-' }}</td>
                        <td class="border p-2 text-center">{{ $kelas->siswa_count }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('nilai.create', ['kelas_id' => $kelas->id]) }}"
                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Lihat & Input Nilai
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Daftar Siswa --}}
        @if ($siswaList->isNotEmpty())
            <h2 class="text-xl font-semibold mb-4">Daftar Siswa Kelas {{ $namaKelasDipilih }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($siswaList as $siswa)
                    <div class="border rounded p-4 shadow hover:bg-gray-50 cursor-pointer"
                         onclick="openModal({{ $siswa->id }}, '{{ $siswa->nama }}')">
                        <h3 class="font-semibold">{{ $siswa->nama }}</h3>
                        <p class="text-sm text-gray-600">NIS: {{ $siswa->nis }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Modal Nilai Siswa --}}
<div id="modalNilai" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-full max-w-2xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold" id="modalTitle">Nilai Siswa</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-600 text-xl">&times;</button>
        </div>
        <div id="modalContent">
            <p class="text-gray-500">Memuat data nilai...</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(siswaId, siswaNama) {
        document.getElementById('modalNilai').style.display = 'flex';
        document.getElementById('modalTitle').textContent = 'Nilai Siswa: ' + siswaNama;

        fetch(`/nilai/siswa/${siswaId}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContent').innerHTML = html;
            });
    }

    function closeModal() {
        document.getElementById('modalNilai').style.display = 'none';
        document.getElementById('modalContent').innerHTML = '<p class="text-gray-500">Memuat data nilai...</p>';
    }
</script>
@endsection
