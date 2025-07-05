@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                required autofocus autocomplete="email">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                required autocomplete="current-password">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="form-checkbox text-blue-600"
                    {{ old('remember') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-600">Remember Me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition">
                Login
            </button>
        </div>
    </form>
</div>
@endsection
