@extends('layouts.frontend')

@section('title', 'Home ')
@section('meta_description', 'This is the SEO optimized home page description.')

@section('content')


   <section class="relative bg-neutral-900 py-24 md:py-32 overflow-hidden">

    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transform animate-hero-zoom"
         style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.15)), url('{{ $heroBannerUrl }}');">
    </div>

    <div class="container relative z-10 mx-auto px-6">
        <div class="max-w-3xl text-white">
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl md:text-5xl">
                Fastest & Reliable Shipment at Your Door.
            </h1>
            <p class="mt-4 text-base text-gray-200 md:text-lg">
                TechPickly offers seamless door-to-door shipping services, ensuring efficient and reliable cargo transport from China to Bangladesh.
            </p>

            <div class="mt-10">
                <div class="flex gap-2 mb-3">
                    <button id="btn-air" onclick="setShippingMethod('air')" class="px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-blue-600 text-white shadow-sm border-b-2 border-blue-600">
                        Air
                    </button>
                    <button id="btn-sea" onclick="setShippingMethod('sea')" class="px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900">
                        Sea
                    </button>
                </div>

                <div class="inline-flex flex-wrap items-center gap-4 bg-neutral-900/90 backdrop-blur-md p-4 rounded-xl rounded-tl-none shadow-2xl border border-neutral-800 w-full sm:w-auto">

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-400 pl-2">From</span>
                        <div class="flex items-center gap-2 bg-white text-gray-900 px-4 py-2 rounded-lg border border-gray-200 select-none">
                            img
                            <span class="text-sm font-semibold pr-4">China</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-400">To</span>
                        <div class="flex items-center gap-2 bg-white text-gray-900 px-4 py-2 rounded-lg border border-gray-200 select-none">
                            <span class="text-xl">🇧🇩</span>
                            <span class="text-sm font-semibold pr-4">Bangladesh</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <a id="booking-submit-btn" href="/booking?method=air" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-8 py-2.5 rounded-lg transition-colors duration-200 shadow-lg shadow-blue-600/20 w-full sm:w-auto text-center">
                        Create Booking
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-blue-600 py-8">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Call Center --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.155-.441.012-.928.387-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Call Center</h3>
                    <p class="text-blue-100 text-sm">Give us a free call</p>
                    <p class="font-semibold">{{ settings('phone') }}</p>
                </div>
            </div>

            {{-- Head Office --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Head Office</h3>
                    <p class="text-blue-100 text-sm">{{ settings('address') }}</p>
                </div>
            </div>

            {{-- Warehouses --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1M2.25 9v12m-1.5-12h1.5m18 0h1.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Warehouses</h3>
                    <p class="text-blue-100 text-sm">See our other warehouses in other countries.</p>
                    <p class="font-semibold">{{ settings('warehouses') }}</p>
                </div>
            </div>

            {{-- Office Hours --}}
            <div class="flex items-center gap-4 text-white">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Office Hours</h3>
                    <p class="text-blue-100 text-sm">Visit us during our office hours.</p>
                    <p class="font-semibold">{{ settings('office_hours') }}</p>
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
            transform: scale(1.18)
        }

        100% {
            transform: scale(1);
        }
    }

    .animate-hero-zoom {
        animation: heroZoom 7s ease-in-out infinite;
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
            airBtn.className = "px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-blue-600 text-white shadow-sm border-b-2 border-blue-600";
            // Sea Inactive
            seaBtn.className = "px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900";
        } else {
            // Sea Active
            seaBtn.className = "px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-blue-600 text-white shadow-sm border-b-2 border-blue-600";
            // Air Inactive
            airBtn.className = "px-5 py-2 text-sm font-semibold rounded-t-lg transition-all duration-200 bg-neutral-900/80 text-gray-300 hover:text-white hover:bg-neutral-900";
        }
    }
</script>


@endsection

@push('script')


@endpush
