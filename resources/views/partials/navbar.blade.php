<ul class="flex items-center space-x-4">
    {{-- Link Tentang --}}
    <li>
        <a href="#tentang" class="hover:underline">Tentang</a>
    </li>

    {{-- Dropdown Fitur --}}
    @include('components.nav.fitur')

    {{-- Link Kontak --}}
    <li>
        <a href="#kontak" class="hover:underline">Kontak</a>
    </li>

    {{-- Dropdown User --}}
    @include('components.nav.user')
</ul>
