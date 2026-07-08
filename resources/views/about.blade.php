@extends('layouts.frontend')

@section('title', 'About Us - Best Product Service')
@section('meta_description', 'Learn more about our services and mission.')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">About Us</h1>
        <p class="text-lg text-gray-600 leading-relaxed mb-8">
            Welcome to Best Product Service. We are committed to providing top-notch logistics and cargo services to our customers. Our mission is to simplify global shipping and ensure your goods reach their destination safely and on time.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-blue-600 text-xl mb-2">Fast</h3>
                <p class="text-gray-500 text-sm">Rapid delivery through our extensive air and sea networks.</p>
            </div>
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-blue-600 text-xl mb-2">Secure</h3>
                <p class="text-gray-500 text-sm">State-of-the-art tracking and secure handling of your packages.</p>
            </div>
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-blue-600 text-xl mb-2">Reliable</h3>
                <p class="text-gray-500 text-sm">Trusted by thousands of customers for their shipping needs.</p>
            </div>
        </div>
    </div>
</div>
@endsection
