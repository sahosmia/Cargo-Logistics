<footer class="bg-[#171443] text-white border-t-4 border-[#ED1C24] pt-16 pb-8 mt-16 relative overflow-hidden">
    {{-- Background details --}}
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_24px] pointer-events-none"></div>

    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 mb-12">

            {{-- Column 1: Company Info --}}
            <div class="md:col-span-5 space-y-4">
                <a href="{{ url('/') }}" class="inline-block bg-white p-2.5 rounded-xl border border-white/10 shadow-md">
                    <img src="{{ $siteLogoUrl }}" alt="{{ settings('app_name', config('app.name')) }} Logo" class="h-12 w-auto object-contain">
                </a>
                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Premium and fastest logistics, cargo, and doorstep parcel shipping solutions. Connecting cargo operations from China to Bangladesh with absolute integrity, linear tracking, and premium safety.
                </p>
                <div class="flex items-center gap-3 text-xs text-slate-400 font-semibold pt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-[#ED1C24]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.745 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.745 0 0 1 3.296-1.043A3.746 3.745 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.745 0 0 1 3.296 1.043 3.746 3.745 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                    <span>Government Authorized Licensed Cargo Carrier</span>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div class="md:col-span-3 space-y-4">
                <h4 class="text-sm font-extrabold uppercase text-white tracking-widest border-b border-white/10 pb-2 inline-block w-full">Quick Navigation</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ url('/') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> Contact Support Desk
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Legal Agreements --}}
            <div class="md:col-span-4 space-y-4">
                <h4 class="text-sm font-extrabold uppercase text-white tracking-widest border-b border-white/10 pb-2 inline-block w-full">Compliance & Policies</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('privacy.policy') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> Privacy Protection Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('return.refund') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> Return & Refund Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms.conditions') }}" class="text-slate-300 hover:text-[#ED1C24] transition-colors flex items-center gap-1.5 font-medium">
                            <span class="text-slate-500">›</span> Terms & Logistics Conditions
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Footer Base --}}
        <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-400 font-medium">
            <div>
                <p>© {{ date('Y') }} {{ settings('app_name', config('app.name')) }}. All operational rights reserved.</p>
            </div>
            <div class="flex items-center gap-1">
                <span>Designed & Programmed with</span>
                <span class="text-[#ED1C24] animate-pulse">❤️</span>
                <span>for TechPickly Logistics</span>
            </div>
        </div>
    </div>
</footer>
