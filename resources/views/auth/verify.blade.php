@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Verifikasi Email</h2>
    <p class="mb-4">Silakan cek email kamu dan klik link verifikasi.</p>

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Kirim Ulang Email Verifikasi
    </button>
</form>
</div>
@endsection
