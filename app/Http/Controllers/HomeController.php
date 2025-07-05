<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
{
    $user = auth()->user();
    $sudahInput = false;

    if ($user->role === 'siswa') {
        $sudahInput = \App\Models\Siswa::where('user_id', $user->id)->exists();
    }

    return view('home', compact('sudahInput'));
}

}
