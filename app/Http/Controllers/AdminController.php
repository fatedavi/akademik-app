<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user() || !auth()->user()->hasVerifiedEmail()) {
            abort(403, 'Akun Anda belum diverifikasi.');
        }
        return view('admin.index');
    }
    public function editRole() 
    {
        if (!auth()->user() || !auth()->user()->hasVerifiedEmail()) {
            abort(403, 'Akun Anda belum diverifikasi.');
        }
        return view('admin.edit-role');
        
    }
}
