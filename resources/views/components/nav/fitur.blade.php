<li class="relative" x-data="{ fiturOpen: false }">
    <button @click="fiturOpen = !fiturOpen" class="hover:underline focus:outline-none">
        Fitur ▾
    </button>

    <div x-show="fiturOpen" @click.away="fiturOpen = false" class="absolute mt-2 bg-white text-gray-700 rounded shadow-md w-40 z-50">
        @auth
            @php $role = auth()->user()->role ?? 'guest'; @endphp

            @if (in_array($role, ['admin', 'guru', 'super_admin']))
                <a href="{{ route('guru.index') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard Guru</a>
                <a href="{{ route('guru.add') }}" class="block px-4 py-2 hover:bg-gray-100">Data Siswa</a>
            @else
                <a href="/siswa" class="block px-4 py-2 hover:bg-gray-100">Lengkapi Data</a>
            @endif
        @else
            <a href="#" class="block px-4 py-2 text-gray-400 cursor-not-allowed">Guest</a>
        @endauth

        <a href="#fitur-guru" class="block px-4 py-2 hover:bg-gray-100">Data Guru</a>
        <a href="/nilai" class="block px-4 py-2 hover:bg-gray-100">Nilai</a>
    </div>
</li>
