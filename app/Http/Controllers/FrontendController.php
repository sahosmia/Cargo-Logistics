<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function home()
    {
        $banner = settings('hero_banner');
        $heroBannerUrl = ! empty($banner)
            ? asset('storage/'.$banner)
            : asset('images/banner-default.jpg');

        return view('home', compact('heroBannerUrl'));
    }

    public function about()
    {
        return view('about');
    }

    public function privacyPolicy()
    {
        $content = settings('privacy_policy', 'Our Privacy Policy content goes here.');

        return view('privacy-policy', compact('content'));
    }

    public function returnRefund()
    {
        $content = settings('return_refund', 'Our Return and Refund policy content goes here.');

        return view('return-refund', compact('content'));
    }

    public function termsConditions()
    {
        $content = settings('terms_conditions', 'Our Terms and Conditions content goes here.');

        return view('terms-conditions', compact('content'));
    }
}
