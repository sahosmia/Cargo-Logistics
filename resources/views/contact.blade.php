@extends('layouts.frontend')

@section('title', 'Contact Us - Best Cargo Services')
@section('meta_description', 'Get in touch with us for any inquiries about our Air & Sea shipping services.')

@section('content')
<div class="relative bg-slate-50 min-h-screen py-16 overflow-hidden">
    {{-- Background Decorative Grid Lines representing global flight & ocean shipping routes --}}
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="container relative z-10 mx-auto px-4 max-w-6xl">
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="px-3.5 py-1.5 text-xs font-bold tracking-widest text-[#ED1C24] uppercase bg-red-500/10 rounded-full border border-red-500/20 inline-block mb-4">
                Support Command Center
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#262262] tracking-tight mb-4">
                We're Here to Navigate Your Cargo
            </h1>
            <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                Have a cargo shipment from China? Need real-time customized pricing or secure custom clearances? Our global logistics managers are ready to assist.
            </p>
        </div>

        {{-- Feedback Status Alerts --}}
        @if(session('success'))
            <div class="mb-10 max-w-4xl mx-auto p-4 rounded-xl bg-green-50 border border-green-200 flex items-center gap-3.5 shadow-sm">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-10 max-w-4xl mx-auto p-4 rounded-xl bg-red-50 border border-red-200 flex items-center gap-3.5 shadow-sm">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-10 max-w-4xl mx-auto p-5 rounded-xl bg-red-50 border border-red-200 flex items-start gap-4 shadow-sm">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-red-800">There were some problems with your submission:</p>
                    <ul class="mt-1.5 text-xs text-red-700 list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Main Two Column Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Left Column: Eye-Catching Interactive Logistics Info Cards --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- Office Location Card --}}
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex items-start gap-5 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-blue-50 text-[#262262] flex items-center justify-center border border-blue-100/60 shadow-sm">
                        {{-- Compass Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Corporate Head Office</h4>
                        <h3 class="text-lg font-bold text-[#262262] mb-1.5">Dhaka Headquarters</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ settings('address') }}</p>
                    </div>
                </div>

                {{-- Phone Support Card --}}
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex items-start gap-5 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-red-50 text-[#ED1C24] flex items-center justify-center border border-red-100/60 shadow-sm">
                        {{-- Phone Call Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.155-.441.012-.928.387-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Direct Operations Desk</h4>
                        <h3 class="text-lg font-bold text-[#262262] mb-1.5">Direct Voice / Whatsapp</h3>
                        <p class="text-base font-extrabold text-[#ED1C24] mb-0.5">{{ settings('phone') }}</p>
                        <p class="text-xs text-slate-400">Available 24/7 for urgent vessel & flight manifest queries.</p>
                    </div>
                </div>

                {{-- Email Support Card --}}
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex items-start gap-5 hover:shadow-md transition-all">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100/60 shadow-sm">
                        {{-- Mail Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Electronic Mailbox</h4>
                        <h3 class="text-lg font-bold text-[#262262] mb-1.5">Invoicing & Sales</h3>
                        <p class="text-sm font-bold text-slate-600">{{ settings('email') }}</p>
                    </div>
                </div>

                {{-- Shipping Mode Icons banner --}}
                <div class="bg-gradient-to-br from-[#262262] to-[#171443] rounded-2xl p-6 text-white shadow-lg flex items-center justify-between overflow-hidden relative">
                    <div class="absolute right-0 bottom-0 translate-y-4 translate-x-4 opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-40 h-40">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </div>
                    <div class="space-y-1 relative z-10">
                        <p class="text-xs font-extrabold text-[#ED1C24] tracking-widest uppercase">Premium Cargo Carriers</p>
                        <h4 class="text-base font-extrabold">Next-Day Air & Weekly Vessels</h4>
                        <p class="text-xs text-slate-300">Custom declarations managed seamlessly.</p>
                    </div>
                    <div class="flex gap-2 shrink-0 relative z-10">
                        <span class="p-2 bg-white/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </span>
                        <span class="p-2 bg-white/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1M2.25 9v12m-1.5-12h1.5m18 0h1.5" />
                            </svg>
                        </span>
                    </div>
                </div>

            </div>

            {{-- Right Column: Beautifully Styled Floating Contact Submission Card --}}
            <div class="lg:col-span-7">
                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#ED1C24]/5 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="mb-6">
                        <h3 class="text-xl font-extrabold text-[#262262] mb-1">Send a Message</h3>
                        <p class="text-xs text-slate-400">Our support coordinators usually respond within 15-30 minutes.</p>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Name input --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Full Name</label>
                            <div class="relative">
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe" class="w-full bg-slate-50 border @error('name') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-1 focus:ring-[#262262] focus:border-[#262262] outline-none transition-all">
                            </div>
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email input --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email Address</label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. johndoe@example.com" class="w-full bg-slate-50 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-1 focus:ring-[#262262] focus:border-[#262262] outline-none transition-all">
                            </div>
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message Input --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Your Message</label>
                            <div class="relative">
                                <textarea name="message" rows="4" placeholder="How can our shipping coordinators help you today? Please provide your tracking number if any." class="w-full bg-slate-50 border @error('message') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-1 focus:ring-[#262262] focus:border-[#262262] outline-none transition-all resize-none">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold py-3.5 rounded-xl shadow-md shadow-red-600/10 hover:shadow-lg transition-all active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer">
                            {{-- Envelope/Send Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            <span>Send Logistics Request</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
