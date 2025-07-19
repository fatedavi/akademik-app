<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SMK Akademik') }}</title>

    {{-- Styles & Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Flowbite (jika digunakan) --}}
    <script src="https://unpkg.com/flowbite@2.2.1/dist/flowbite.min.js" defer></script>

    {{-- Tom Select (searchable dropdown) --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

@php
    $routeName = request()->route()->getName();
    $showSidebar = !in_array($routeName, ['landing']); // Sembunyikan sidebar di halaman tertentu
@endphp

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- Sidebar --}}
    @if($showSidebar)
        <aside
            :class="sidebarOpen ? 'w-64' : 'w-16'"
            class="bg-white shadow-md border-r transition-all duration-300 ease-in-out overflow-hidden flex flex-col"
        >
            <div class="flex items-center justify-between p-4 bg-blue-600 text-white">
                <span x-show="sidebarOpen" class="font-bold">Dashboard</span>
                <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 p-2 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-100">
                    <span class="text-xl">🏠</span>
                    <span x-show="sidebarOpen">Beranda</span>
                </a>
                <a href="{{ route('siswa.index') }}" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-100">
                    <span class="text-xl">📘</span>
                    <span x-show="sidebarOpen">Data Siswa</span>
                </a>
                <a href="{{ route('nilai.index') }}" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-100">
                    <span class="text-xl">📊</span>
                    <span x-show="sidebarOpen">Nilai</span>
                </a>
                <a href="#" class="flex items-center space-x-2 p-2 text-gray-400 cursor-not-allowed">
                    <span class="text-xl">⚙️</span>
                    <span x-show="sidebarOpen">Pengaturan</span>
                </a>
            </nav>
        </aside>
    @endif

    {{-- Konten Utama --}}
    <div class="flex-1 flex flex-col w-full">

        {{-- Header --}}
        <header class="bg-blue-500 text-white shadow-md p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-gray-800">SMK Akademik</h1>
            </div>
            {{-- Navbar --}}
            @include('partials.navbar')
        </header>

        {{-- Konten Halaman --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-800 text-white text-center p-4">
            &copy; {{ date('Y') }} SMK Akademik. All rights reserved.
        </footer>

    </div>
</div>
    @yield('scripts')
    @stack('scripts')
</body>

</html>
