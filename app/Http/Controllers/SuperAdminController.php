<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('super_admin.index');
    }
    public function management()
    {
        // Logic for managing users, roles, etc.
        return view('super_admin.management');
    }
}
