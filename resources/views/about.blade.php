@extends('layouts.frontend')

@section('title', 'About Us - Premium Logistics & Cargo Services')
@section('meta_description', 'Learn more about SkyShip logistics services, China to Bangladesh Express cargo routing, and our core values.')

@section('content')
<div class="relative bg-slate-50 min-h-screen py-16 overflow-hidden">
    {{-- Background grid line patterns representing route directions --}}
    <div class="absolute inset-0 z-0 opacity-45 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="container relative z-10 mx-auto px-4 max-w-5xl text-center">
        {{-- Header Section --}}
        <div class="max-w-3xl mx-auto mb-16">
            <span class="px-3.5 py-1.5 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-4">
                Our Corporate Identity
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#262262] tracking-tight mb-6">
                Redefining China to Bangladesh Cargo Carrier Services
            </h1>
            <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                Welcome to <span class="font-bold text-[#262262]">{{ settings('app_name', config('app.name')) }}</span>. We are deeply committed to offering world-class express air and weekly sea cargo shipping solutions. Our primary mission is to simplify global supply chains, secure custom declarations, and guarantee that your valuable goods reach their destination perfectly on time.
            </p>
        </div>

        {{-- Core Values Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 text-left">
            {{-- Card 1: Fast --}}
            <div class="bg-white border border-slate-200/80 p-8 rounded-3xl shadow-sm hover:shadow-md transition-all">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-red-50 text-[#ED1C24] flex items-center justify-center border border-red-100/60 shadow-inner mb-6">
                    {{-- Plane Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </div>
                <h3 class="font-extrabold text-[#262262] text-xl mb-3">Rapid Transport</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Enjoy next-day flight dispatches and accelerated sea cargo channels connected directly with premium logistics partners.
                </p>
            </div>

            {{-- Card 2: Secure --}}
            <div class="bg-white border border-slate-200/80 p-8 rounded-3xl shadow-sm hover:shadow-md transition-all">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-blue-50 text-[#262262] flex items-center justify-center border border-blue-100/60 shadow-inner mb-6">
                    {{-- Shield Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.745 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.745 0 0 1 3.296-1.043A3.746 3.745 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.745 0 0 1 3.296 1.043 3.746 3.745 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <h3 class="font-extrabold text-[#262262] text-xl mb-3">Absolute Security</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    State-of-the-art warehouses, automated barcode scanning, safe storage compartments, and full cargo protection coverage.
                </p>
            </div>

            {{-- Card 3: Reliable --}}
            <div class="bg-white border border-slate-200/80 p-8 rounded-3xl shadow-sm hover:shadow-md transition-all">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100/60 shadow-inner mb-6">
                    {{-- Anchor Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21V9.75M20 12h.008v.008H20V12Zm-16 0h.008v.008H4V12Zm6-7.25a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0Z" />
                    </svg>
                </div>
                <h3 class="font-extrabold text-[#262262] text-xl mb-3">Trusted Reliability</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Thousands of registered import clients, dedicated custom clearing agents, and 100% linear timeline updates.
                </p>
            </div>
        </div>

        {{-- Interactive Operational Highlight banner --}}
        <div class="bg-gradient-to-br from-[#262262] to-[#171443] rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden text-left">
            <div class="absolute right-0 bottom-0 translate-y-10 translate-x-10 opacity-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-96 h-96">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                </svg>
            </div>
            <div class="max-w-2xl relative z-10 space-y-6">
                <span class="px-3 py-1 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-white/10 rounded-full border border-white/10 inline-block">
                    Operational Excellence
                </span>
                <h3 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Our Dedicated Warehousing & Logistics</h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    We maintain extensive storage hubs and warehouse setups to safely collect and verify weights. From our secure loading facilities in China directly to our central distribution offices in Dhaka, our systems are optimized for full transparency.
                </p>
                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl bg-[#ED1C24] hover:bg-[#D01E2A] px-6 py-3 text-sm font-bold text-white shadow-md transition-all">
                        Talk with Support
                    </a>
                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 px-6 py-3 text-sm font-bold text-white transition-all">
                        Track Shipment
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
