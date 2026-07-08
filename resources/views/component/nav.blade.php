<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm p-4 transition-all duration-200">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="inline-flex items-center justify-center">
            <img src="{{ $siteLogoUrl }}" alt="{{ config('app.name') }} Logo" class="max-w-25">
        </a>
        <div class="flex items-center justify-between gap-6">
            <nav class="flex items-center gap-4">
                <a href="{{ url('/') }}"
                    class="text-sm font-medium text-gray-600 transition-colors duration-200 hover:text-blue-600">Home</a>
                <a href="{{ url('/about') }}"
                    class="text-sm font-medium text-gray-600 transition-colors duration-200 hover:text-blue-600">About</a>
            </nav>

            <div class="flex items-center">
                @guest('customer')
                @guest('web')
                <a href="{{ route('customer.login') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </a>
                @endguest
                @endguest

                @auth('customer')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>

                    <div class="flex flex-col pr-2">
                        <span class="text-sm font-semibold text-gray-800 leading-tight">
                            {{ auth('customer')->user()->name }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ auth('customer')->user()->phone_number ?? 'ID: ' . auth('customer')->user()->id }}
                        </span>
                    </div>
                </a>
                @endauth

                @auth('web')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>

                    <div class="flex flex-col pr-2">
                        <span class="text-sm font-semibold text-gray-800 leading-tight">
                            {{ auth('web')->user()->name }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ auth('web')->user()->email ?? 'ID: ' . auth('web')->user()->id }}
                        </span>
                    </div>
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
