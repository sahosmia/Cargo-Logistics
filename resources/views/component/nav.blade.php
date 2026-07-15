<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100 p-4 transition-all duration-200">
    <div class="container mx-auto flex justify-between items-center max-w-6xl">
        {{-- Brand Logo --}}
        <a href="{{ url('/') }}" class="inline-flex items-center justify-center">
            <img src="{{ $siteLogoUrl }}" alt="{{ settings('app_name', config('app.name')) }} Logo" class="max-w-25 h-10 object-contain">
        </a>

        {{-- Navigation Menu & User Profiles --}}
        <div class="flex items-center gap-6">
            <nav class="flex items-center gap-5 mr-2">
                <a href="{{ url('/') }}"
                    class="text-sm font-semibold text-[#262262] transition-colors duration-200 hover:text-[#ED1C24]">Home</a>
                <a href="{{ route('about') }}"
                    class="text-sm font-semibold text-[#262262] transition-colors duration-200 hover:text-[#ED1C24]">About</a>
                <a href="{{ route('contact') }}"
                    class="text-sm font-semibold text-[#262262] transition-colors duration-200 hover:text-[#ED1C24]">Contact</a>
            </nav>

            <div class="flex items-center border-l border-slate-200 pl-6">
                {{-- Guest User Login Button --}}
                @guest('customer')
                @guest('web')
                <a href="{{ route('customer.login') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-[#ED1C24] hover:bg-[#D01E2A] px-5 py-2 text-sm font-bold text-white shadow-sm shadow-red-600/15 transition-all duration-200">
                    Login
                </a>
                @endguest
                @endguest

                {{-- Customer Account Dropdown --}}
                @auth('customer')
                <div class="relative group">
                    <button class="flex items-center gap-3 p-1.5 hover:bg-slate-50 rounded-xl transition-colors duration-200 focus:outline-none">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-[#ED1C24] border border-red-100/60 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>

                        <div class="hidden sm:flex flex-col text-left pr-2">
                            <span class="text-sm font-bold text-[#262262] leading-tight">
                                {{ auth('customer')->user()->name }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ auth('customer')->user()->phone_number ?? 'Client' }}
                            </span>
                        </div>
                    </button>

                    {{-- Hover Dropdown List --}}
                    <div class="absolute right-0 mt-1 w-52 bg-white border border-slate-100 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2 border-t-2 border-t-[#ED1C24]">
                        <div class="px-4 py-2 border-b border-slate-100 mb-1">
                            <p class="text-xs text-slate-400 font-medium">Customer Area</p>
                            <p class="text-sm font-bold text-[#262262] truncate">{{ auth('customer')->user()->name }}</p>
                        </div>

                        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-[#262262] transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75c.621 0 1.125.504 1.125 1.125v1.375H4.5V5.625c0-.621.504-1.125 1.125-1.125Z" />
                            </svg>
                            <span>Booking List</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-[#262262] transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>My Profile</span>
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        <form action="{{ route('customer.logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-2.5 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                {{-- Admin Account Dropdown --}}
                @auth('web')
                <div class="relative group">
                    <button class="flex items-center gap-3 p-1.5 hover:bg-slate-50 rounded-xl transition-colors duration-200 focus:outline-none">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-[#262262] border border-blue-100/60 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>

                        <div class="hidden sm:flex flex-col text-left pr-2">
                            <span class="text-sm font-bold text-[#262262] leading-tight">
                                {{ auth('web')->user()->name }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ auth('web')->user()->email ? 'Staff' : 'Admin' }}
                            </span>
                        </div>
                    </button>

                    {{-- Hover Dropdown List --}}
                    <div class="absolute right-0 mt-1 w-52 bg-white border border-slate-100 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2 border-t-2 border-t-[#262262]">
                        <div class="px-4 py-2 border-b border-slate-100 mb-1">
                            <p class="text-xs text-slate-400 font-medium">Control Room</p>
                            <p class="text-sm font-bold text-[#262262] truncate">{{ auth('web')->user()->name }}</p>
                        </div>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-[#262262] transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75c.621 0 1.125.504 1.125 1.125v1.375H4.5V5.625c0-.621.504-1.125 1.125-1.125Z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-[#262262] transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>My Profile</span>
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-2.5 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
