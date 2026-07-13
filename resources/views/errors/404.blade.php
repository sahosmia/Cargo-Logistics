@extends('layouts.frontend')

@section('title', '404 - Page Not Found')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4 py-16">
    <div class="bg-blue-50 text-blue-600 rounded-full p-4 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
    </div>
    <h1 class="text-6xl font-extrabold text-gray-900 tracking-tight mb-4">404</h1>
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Oops! Page Not Found</h2>
    <p class="text-gray-600 max-w-md mb-8">
        The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
    </p>
    <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-lg shadow-blue-600/10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Go Back Home
    </a>
</div>
@endsection
