<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth('customer')->check() || auth('web')->check()) {
            return redirect()->route('dashboard');
        }

        return view('home');
    }
}
