<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Wyświetl stronę "O projekcie"
     */
    public function index()
    {
        return view('about.index');
    }
}
