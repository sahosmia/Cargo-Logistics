@extends('layouts.frontend')

@section('title', 'Contact Us - Best Product Service')
@section('meta_description', 'Get in touch with us for any inquiries.')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
            <p class="text-lg text-gray-600">Have questions? We're here to help.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-8">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Our Office</h3>
                    <p class="text-gray-600">{{ settings('address') }}</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Phone</h3>
                    <p class="text-gray-600">{{ settings('phone') }}</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">{{ settings('email') }}</p>
                </div>
            </div>

            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm">
                <form action="#" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea rows="4" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-600/10 transition-all active:scale-95">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
