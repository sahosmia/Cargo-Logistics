<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function home()
    {
        $banner = settings('hero_banner');
        $heroBannerUrl = ($banner && Storage::disk('public')->exists($banner))
            ? Storage::disk('public')->url($banner)
            : asset('images/banner-default.jpg');

        return view('home', compact('heroBannerUrl'));
    }

    public function about()
    {
        return view('about');
    }
}
