<footer class="bg-gray-800 text-white py-8 mt-10">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-center md:text-left">
                <p class="text-sm text-gray-400">
                    © {{ date('Y') }} {{ settings('app_name', config('app.name')) }}. All rights reserved.
                </p>
            </div>
            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <a href="{{ route('privacy.policy') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy Policy</a>
                <a href="{{ route('return.refund') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Return & Refund Policy</a>
                <a href="{{ route('terms.conditions') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
