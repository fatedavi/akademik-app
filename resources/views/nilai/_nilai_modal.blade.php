@if ($nilaiList->isEmpty())
    <p class="text-gray-500">Belum ada nilai untuk siswa ini.</p>
@else
    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Mata Pelajaran</th>
                <th class="border p-2">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaiList as $nilai)
                <tr>
                    <td class="border p-2">{{ $nilai->subject->name }}</td>
                    <td class="border p-2 text-center">{{ $nilai->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
