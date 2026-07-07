@extends('layouts.frontend')

@section('title', 'Home - Best Product Service')
@section('meta_description', 'This is the SEO optimized home page description.')

@section('content')


   <section class="relative bg-neutral-900 py-24 md:py-32 overflow-hidden">
    
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transform animate-hero-zoom" 
         style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('{{ asset('images/banner-default.jpg') }}');">
    </div>

    <div class="container relative z-10 mx-auto px-6">
        <div class="max-w-3xl text-white">
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl md:text-5xl">
                Fastest & Reliable Shipment at Your Door.
            </h1>
            <p class="mt-4 text-base text-gray-200 md:text-lg">
                SkyShip offers seamless door-to-door shipping services, ensuring efficient and reliable cargo transport from China to Bangladesh.
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
                            <span class="text-xl">🇨🇳</span>
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

<style>
    @keyframes heroZoom {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.12); 
        }
        100% {
            transform: scale(1); 
        }
    }

    .animate-hero-zoom {
        animation: heroZoom 8s ease-in-out infinite; 
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
