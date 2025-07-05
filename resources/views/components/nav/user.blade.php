<li class="relative" x-data="{ userOpen: false }">
    <button @click="userOpen = !userOpen" class="hover:underline focus:outline-none">
        @auth
            {{ Auth::user()->name }} ▾
        @else
            Guest ▾
        @endauth
    </button>

    <div x-show="userOpen" @click.away="userOpen = false" class="absolute right-0 mt-2 bg-white text-gray-700 rounded shadow-md w-40 z-50">
        @auth
            <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">Daftar</a>
        @endauth
    </div>
</li>
