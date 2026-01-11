<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        return view('admin.dashboard');
    }
}
