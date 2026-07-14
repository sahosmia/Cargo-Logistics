@extends('layouts.frontend')

@section('title', 'Home - Express Air & Ocean Shipping')
@section('meta_description', 'SkyShip offers fastest and reliable doorstep cargo transport services from China to Bangladesh.')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-neutral-900 py-24 md:py-32 overflow-hidden">
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transform animate-hero-zoom"
         style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.2)), url('{{ $heroBannerUrl }}');">
    </div>

    <div class="container relative z-10 mx-auto px-6 max-w-6xl">
        <div class="max-w-3xl text-white">
            <span class="px-3 py-1.5 text-xs font-extrabold tracking-widest text-white uppercase bg-[#ED1C24] rounded-lg inline-block mb-4">
                China to Bangladesh Premium Cargo Carrier
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl leading-tight">
                Fastest & Reliable Shipment at Your Door.
            </h1>
            <p class="mt-4 text-base text-gray-200 md:text-lg max-w-xl leading-relaxed">
                Seamless door-to-door cargo transport from China to Bangladesh. Experience rapid custom clearing and express transit times today.
            </p>

            <div class="mt-10">
                <div class="flex gap-2 mb-3">
                    <button id="btn-air" onclick="setShippingMethod('air')" class="px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-[#ED1C24] text-white shadow-sm border-b-2 border-[#ED1C24] cursor-pointer">
                        Air Shipping
                    </button>
                    <button id="btn-sea" onclick="setShippingMethod('sea')" class="px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900 cursor-pointer">
                        Sea Cargo
                    </button>
                </div>

                <div class="inline-flex flex-wrap items-center gap-4 bg-neutral-900/90 backdrop-blur-md p-4 rounded-2xl rounded-tl-none shadow-2xl border border-neutral-800 w-full sm:w-auto">

                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-gray-400 uppercase pl-2">From</span>
                        <div class="flex items-center gap-2.5 bg-white text-gray-900 px-4 py-2 rounded-xl border border-gray-200 select-none shadow-sm">
                            <img src="{{ asset('images/flag/china.webp') }}" alt="China Flag" class="w-6 h-4 rounded object-cover shadow-sm">
                            <span class="text-sm font-bold pr-2">China</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-gray-400 uppercase">To</span>
                        <div class="flex items-center gap-2.5 bg-white text-gray-900 px-4 py-2 rounded-xl border border-gray-200 select-none shadow-sm">
                            <img src="{{ asset('images/flag/bd.webp') }}" alt="Bangladesh Flag" class="w-6 h-4 rounded object-cover shadow-sm">
                            <span class="text-sm font-bold pr-2">Bangladesh</span>
                        </div>
                    </div>

                    <a id="booking-submit-btn" href="/booking?method=air" class="inline-flex items-center justify-center bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold text-sm px-8 py-3 rounded-xl transition-colors duration-200 shadow-lg shadow-red-600/20 w-full sm:w-auto text-center cursor-pointer">
                        Create Booking
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- Info Banner Section styled in premium brand-navy --}}
<section class="bg-[#262262] py-8 border-b border-slate-100/10">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Call Center --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 shadow-inner text-[#ED1C24]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.155-.441.012-.928.387-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold uppercase text-slate-300 tracking-wider">Call Center</h3>
                    <p class="font-bold text-base text-white">{{ settings('phone') }}</p>
                </div>
            </div>

            {{-- Head Office --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 shadow-inner text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold uppercase text-slate-300 tracking-wider">Head Office</h3>
                    <p class="text-xs text-slate-200 leading-tight">{{ settings('address') }}</p>
                </div>
            </div>

            {{-- Warehouses --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 shadow-inner text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1M2.25 9v12m-1.5-12h1.5m18 0h1.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold uppercase text-slate-300 tracking-wider">Warehouses</h3>
                    <p class="text-xs text-slate-200 font-bold leading-tight">{{ settings('warehouses') }}</p>
                </div>
            </div>

            {{-- Office Hours --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 shadow-inner text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold uppercase text-slate-300 tracking-wider">Office Hours</h3>
                    <p class="text-xs text-slate-200 font-bold leading-tight">{{ settings('office_hours') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes heroZoom {
        0% {
            transform: scale(1);
        }

        50%{
            transform: scale(1.15)
        }

        100% {
            transform: scale(1);
        }
    }

    .animate-hero-zoom {
        animation: heroZoom 10s ease-in-out infinite;
    }
</style>

<script>
    function setShippingMethod(method) {
        const airBtn = document.getElementById('btn-air');
        const seaBtn = document.getElementById('btn-sea');
        const submitBtn = document.getElementById('booking-submit-btn');

        submitBtn.setAttribute('href', `/booking?method=${method}`);

        if (method === 'air') {
            // Air Active
            airBtn.className = "px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-[#ED1C24] text-white shadow-sm border-b-2 border-[#ED1C24] cursor-pointer";
            // Sea Inactive
            seaBtn.className = "px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900 cursor-pointer";
        } else {
            // Sea Active
            seaBtn.className = "px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-[#ED1C24] text-white shadow-sm border-b-2 border-[#ED1C24] cursor-pointer";
            // Air Inactive
            airBtn.className = "px-6 py-2.5 text-sm font-extrabold rounded-t-xl transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900 cursor-pointer";
        }
    }
</script>


@endsection

@push('script')


@endpush
