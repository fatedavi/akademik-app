<li class="relative" x-data="{ fiturOpen: false }">
    <button @click="fiturOpen = !fiturOpen" class="hover:underline focus:outline-none">
        Fitur ▾
    </button>

    <div x-show="fiturOpen" @click.away="fiturOpen = false" class="absolute mt-2 bg-white text-gray-700 rounded shadow-md w-48 z-50">
        @auth
            @php $role = auth()->user()->role ?? 'guest'; @endphp

            @if ($role === 'admin')
                <a href="{{ route('admin.index') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard Admin</a>
                <a href="{{ route('guru.create') }}" class="block px-4 py-2 hover:bg-gray-100">Data Guru</a>
                <a href="{{ route('siswa.addSiswa') }}" class="block px-4 py-2 hover:bg-gray-100">Data Siswa</a>
                <a href="{{ route('admin.edit-role') }}" class="block px-4 py-2 hover:bg-gray-100">Manajemen Role</a>
            @elseif ($role === 'guru')
                <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard Guru</a>
                <a href="{{ route('siswa.create') }}" class="block px-4 py-2 hover:bg-gray-100">Data Siswa</a>
                <a href="{{ route('nilai.index') }}" class="block px-4 py-2 hover:bg-gray-100">Nilai</a>
            @elseif ($role === 'super_admin')
                <a href="{{ route('superadmin.index') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard Superadmin</a>
            @else
                <a href="/siswa" class="block px-4 py-2 hover:bg-gray-100">Lengkapi Data</a>
            @endif
        @else
            <a href="#" class="block px-4 py-2 text-gray-400 cursor-not-allowed">Guest</a>
        @endauth
    </div>
</li>
