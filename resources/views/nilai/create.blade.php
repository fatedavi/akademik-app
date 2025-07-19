@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Daftar Siswa - Kelas {{ $kelas->nama }}</h1>

        <table class="w-full border mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2 text-left">No</th>
                    <th class="border p-2 text-left">Nama Siswa</th>
                    <th class="border p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaList as $index => $siswa)
                    <tr>
                        <td class="border p-2">{{ $index + 1 }}</td>
                        <td class="border p-2">{{ $siswa->nama }}</td>
                        <td class="border p-2">
                            <a href="javascript:void(0);"
                               onclick="openModal('{{ $siswa->id }}', '{{ $siswa->nama }}')"
                               class="text-blue-600 hover:underline">
                               Input / Lihat Nilai
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('nilai.index') }}" class="text-sm text-gray-600 hover:underline">
            &larr; Kembali ke Daftar Kelas
        </a>
    </div>
</div>

<!-- Modal -->
<div id="nilaiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
        <h2 class="text-xl font-bold mb-4">Input Nilai</h2>

        <form id="nilaiForm" method="POST" action="{{ route('nilai.store') }}">
            @csrf
            <input type="hidden" id="modalSiswaId">

            <div class="mb-4">
                <label class="block mb-1 text-sm text-gray-700">Nama Siswa</label>
                <input type="text" id="modalSiswaNama" class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4">
                <label for="subject_id" class="block mb-1 text-sm text-gray-700">Mata Pelajaran</label>
                <select id="modalSubjectId" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nilai" class="block mb-1 text-sm text-gray-700">Nilai</label>
                <input type="number" id="modalNilai" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Nilai</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(siswaId, siswaNama) {
        document.getElementById('modalSiswaId').value = siswaId;
        document.getElementById('modalSiswaNama').value = siswaNama;
        document.getElementById('modalSubjectId').value = '';
        document.getElementById('modalNilai').value = '';
        document.getElementById('nilaiModal').classList.remove('hidden');
        document.getElementById('nilaiModal').classList.add('flex');

        // Update form input name dynamically
        const form = document.getElementById('nilaiForm');
        form.onsubmit = function () {
            const subjectId = document.getElementById('modalSubjectId').value;
            const nilai = document.getElementById('modalNilai').value;

            // Create hidden inputs dynamically
            const hiddenSubject = document.createElement('input');
            hiddenSubject.type = 'hidden';
            hiddenSubject.name = `nilai[${siswaId}][subject_id]`;
            hiddenSubject.value = subjectId;

            const hiddenNilai = document.createElement('input');
            hiddenNilai.type = 'hidden';
            hiddenNilai.name = `nilai[${siswaId}][nilai]`;
            hiddenNilai.value = nilai;

            form.appendChild(hiddenSubject);
            form.appendChild(hiddenNilai);

            return true;
        };
    }

    function closeModal() {
        document.getElementById('nilaiModal').classList.add('hidden');
        document.getElementById('nilaiModal').classList.remove('flex');
    }

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('nilaiModal');
        if (e.target === modal) {
            closeModal();
        }
    });
</script>
@endpush
