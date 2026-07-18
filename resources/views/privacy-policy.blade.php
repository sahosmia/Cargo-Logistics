@extends('layouts.frontend')

@section('title', 'Privacy Policy - ' . settings('app_name', config('app.name')))
@section('meta_description', 'Read our Privacy Policy and understand how we protect your personal and cargo details.')

@section('content')
<div class="relative bg-slate-50 min-h-screen py-16 overflow-hidden">
    {{-- Decorative backgrounds --}}
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="container relative z-10 mx-auto px-4 max-w-4xl">
        <div class="bg-white p-8 sm:p-12 rounded-3xl border border-slate-200/80 shadow-xl relative overflow-hidden">
            {{-- Top brand border --}}
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#ED1C24]"></div>

            <div class="mb-10 pb-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <span class="px-2.5 py-1 text-[10px] font-extrabold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-2">
                        Compliance Guidelines
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#262262] tracking-tight">Privacy Policy</h1>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Latest Revision</p>
                    <p class="text-sm font-bold text-[#262262]">{{ date('F Y') }}</p>
                </div>
            </div>

            <div class="text-slate-600 leading-relaxed text-left text-sm sm:text-base prose max-w-none space-y-6">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>
@endsection
