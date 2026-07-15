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
            <span class="px-3.5 py-1.5 text-xs font-extrabold tracking-widest text-white uppercase bg-[#ED1C24] rounded-lg inline-block mb-4 border border-red-500/20">
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

{{-- Section: Our Shipping Services & Estimation --}}
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-6xl">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="px-3.5 py-1.5 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-4">
                Our Fleet Capabilities
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#262262] tracking-tight mb-4">
                Air vs. Ocean Shipping Solutions
            </h2>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Choose the best transportation method tailored for your specific parcel weights, deadlines, and delivery conditions.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Air Freight Card --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="p-3.5 bg-red-50 text-[#ED1C24] rounded-2xl border border-red-100/50 shadow-inner inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold text-green-700 bg-green-50 rounded-full border border-green-200 uppercase">Express Dispatch</span>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-2xl font-extrabold text-[#262262]">Express Air Cargo</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            The ultimate speed solution for high-value goods, garments, and lightweight parcels. Direct custom clearing from Dhaka Cantonment / Airport.
                        </p>
                    </div>

                    <ul class="space-y-3.5 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Transit Time:</strong> 3 to 7 Days maximum
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Minimum Weight:</strong> 1 KG threshold
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Security Level:</strong> Maximum protected transit
                        </li>
                    </ul>
                </div>

                <div class="pt-8">
                    <a href="/booking?method=air" class="w-full inline-flex items-center justify-center bg-[#262262] hover:bg-[#171443] text-white font-bold py-3.5 rounded-2xl transition-colors cursor-pointer text-sm shadow-sm">
                        Create Air Booking
                    </a>
                </div>
            </div>

            {{-- Ocean Cargo Card --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="p-3.5 bg-blue-50 text-[#262262] rounded-2xl border border-blue-100/50 shadow-inner inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1M2.25 9v12m-1.5-12h1.5m18 0h1.5" />
                            </svg>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold text-[#ED1C24] bg-red-50 rounded-full border border-red-200 uppercase">Cost-Effective</span>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-2xl font-extrabold text-[#262262]">Secure Sea Cargo</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Optimal for bulk machinery, heavy raw materials, furniture, or volume cartons. Secure container consolidation from key China ports to Chittagong / Dhaka distribution warehouses.
                        </p>
                    </div>

                    <ul class="space-y-3.5 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Transit Time:</strong> 18 to 30 Days maximum
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Minimum Weight:</strong> 20 KG threshold
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-green-500">✓</span> <strong>Security Level:</strong> Safe consolidated bulk load
                        </li>
                    </ul>
                </div>

                <div class="pt-8">
                    <a href="/booking?method=sea" class="w-full inline-flex items-center justify-center bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold py-3.5 rounded-2xl transition-colors cursor-pointer text-sm shadow-sm">
                        Create Sea Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: How It Works (Easy 4-Step Process) --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="px-3.5 py-1.5 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-4">
                Operational Framework
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#262262] tracking-tight mb-4">
                Our Easy 4-Step Shipping Process
            </h2>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                We handle everything from China warehouse storage, manifest creation, customs clearance, to Bangladesh Cantonment distribution.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            {{-- Step 1 --}}
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all relative">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-xl bg-[#262262] text-white flex items-center justify-center font-black shadow-md">
                    01
                </div>
                <div class="pt-4 space-y-3">
                    <h4 class="font-extrabold text-lg text-[#262262]">Create Booking</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Fill in carton pieces, total quantity, choose air/sea shipping, and enter your delivery district.
                    </p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all relative">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-xl bg-[#ED1C24] text-white flex items-center justify-center font-black shadow-md">
                    02
                </div>
                <div class="pt-4 space-y-3">
                    <h4 class="font-extrabold text-lg text-[#262262]">Warehouse Storage</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Send cargo package to our China warehouse. We scan the barcode and generate your collision-safe Shipping Mark.
                    </p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all relative">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-xl bg-[#262262] text-white flex items-center justify-center font-black shadow-md">
                    03
                </div>
                <div class="pt-4 space-y-3">
                    <h4 class="font-extrabold text-lg text-[#262262]">Customs & Transit</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        We handle custom declarations, export manifests, and securely transfer cargo across international borders.
                    </p>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all relative">
                <div class="absolute -top-4 left-6 w-10 h-10 rounded-xl bg-[#ED1C24] text-white flex items-center justify-center font-black shadow-md">
                    04
                </div>
                <div class="pt-4 space-y-3">
                    <h4 class="font-extrabold text-lg text-[#262262]">Doorstep Delivery</h4>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Pick up cargo packages directly from our secure Dhaka Cantonment headquarters, or request doorstep dispatch.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Why Choose SkyShip Logistics --}}
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-6xl">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="px-3.5 py-1.5 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-4">
                Our Competitive Advantage
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#262262] tracking-tight mb-4">
                Why Thousands Trust SkyShip Logistics
            </h2>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Discover the direct logistics advantages that separate us from typical clearing agents and cargo handlers.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Feature 1 --}}
            <div class="bg-white border border-slate-200/80 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-green-500 text-2xl font-bold">✓</span>
                    <h4 class="font-extrabold text-base text-[#262262]">100% Insured Shipments</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">We protect your cargo from physical impact or transit loss during maritime and air carriage.</p>
                </div>
            </div>

            {{-- Feature 2 --}}
            <div class="bg-white border border-slate-200/80 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-green-500 text-2xl font-bold">✓</span>
                    <h4 class="font-extrabold text-base text-[#262262]">Real-time Tracking</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Access our portal at any moment to visualize the complete, linear status history of your cargo container.</p>
                </div>
            </div>

            {{-- Feature 3 --}}
            <div class="bg-white border border-slate-200/80 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-green-500 text-2xl font-bold">✓</span>
                    <h4 class="font-extrabold text-base text-[#262262]">Transparent Weight Pricing</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Zero cubic meter (CBM) calculations or confusing sizing variables. We only bill on Actual Weight (KG).</p>
                </div>
            </div>

            {{-- Feature 4 --}}
            <div class="bg-white border border-slate-200/80 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-green-500 text-2xl font-bold">✓</span>
                    <h4 class="font-extrabold text-base text-[#262262]">No Hidden Customs Fees</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">All custom processing and import duties are consolidated directly into your initial weight billing quote.</p>
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
