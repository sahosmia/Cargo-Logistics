@extends('layouts.frontend')

@section('title', '404 - Cargo Route Lost')

@section('content')
<div class="relative bg-slate-50 min-h-[75vh] flex flex-col items-center justify-center text-center px-4 py-16 overflow-hidden">
    {{-- Decorative backgrounds representing global pathways --}}
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="relative z-10 max-w-xl bg-white border border-slate-200/80 p-8 sm:p-12 rounded-3xl shadow-xl flex flex-col items-center justify-center">
        {{-- Top brand accent line --}}
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-[#ED1C24]"></div>

        {{-- Beautiful Branded Lost Compass SVG --}}
        <div class="w-20 h-20 bg-red-50 text-[#ED1C24] rounded-2xl flex items-center justify-center border border-red-100/50 shadow-inner mb-8 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21V9.75M20 12h.008v.008H20V12Zm-16 0h.008v.008H4V12Zm6-7.25a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0Z" />
            </svg>
        </div>

        <h1 class="text-7xl font-black text-[#262262] tracking-tighter mb-4">404</h1>
        <h2 class="text-2xl font-extrabold text-[#262262] tracking-tight mb-3">Cargo Route Lost</h2>
        <p class="text-sm sm:text-base text-slate-500 max-w-sm leading-relaxed mb-8">
            The logistical route or cargo link you are trying to trace is currently unavailable, has been cleared, or does not exist.
        </p>

        {{-- Return Back Button --}}
        <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-7 py-3.5 border border-transparent text-sm font-bold rounded-xl text-white bg-[#ED1C24] hover:bg-[#D01E2A] transition-all shadow-md shadow-red-600/10 hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] focus:outline-none cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mr-2 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Return to Home Route</span>
        </a>
    </div>
</div>
@endsection
