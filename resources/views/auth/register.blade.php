<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Akun</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="w-full px-3 py-2 border rounded" required autofocus>
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="w-full px-3 py-2 border rounded" required>
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input id="password" type="password" name="password"
                class="w-full px-3 py-2 border rounded" required>
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="w-full px-3 py-2 border rounded" required>
        </div>

        <!-- Tombol -->
        <div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full">
                Daftar
            </button>
        </div>
    </form>

    <p class="text-sm mt-4 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>
@endsection
