@extends('layouts.frontend')

@section('title', 'Create Cargo Booking - TechPickly Premium Logistics')
@section('meta_description', 'Book your air or ocean shipping from China to Bangladesh. Secure weight-based pricing and door doorstep custom clearances.')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border-radius: 0.75rem !important;
            padding: 0.65rem 0.85rem !important;
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
            border-color: #cbd5e1 !important;
            background-color: #f8fafc !important;
            color: #1e293b !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }
        .ts-wrapper.focus .ts-control {
            box-shadow: 0 0 0 3px rgba(38, 34, 98, 0.15) !important;
            border-color: #262262 !important;
            background-color: #ffffff !important;
        }
        .ts-dropdown {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            border-color: #f1f5f9 !important;
            margin-top: 4px !important;
        }
    </style>
@endpush

@section('content')
<form action="{{ route('customer.booking.store') }}" method="POST" class="bg-slate-50 py-10 relative overflow-hidden min-h-screen">
    {{-- Background grid line patterns representing global air & sea shipping lanes --}}
    <div class="absolute inset-0 z-0 opacity-40 bg-[radial-gradient(#dbdaf0_1px,transparent_1px)] [background-size:24px_24px]"></div>

    @csrf
    <div class="container relative z-10 mx-auto px-4 max-w-6xl">

        @if(session('success'))
            <div class="mb-8 max-w-4xl mx-auto p-4 rounded-xl bg-green-50 border border-green-200 flex items-center gap-3.5 shadow-sm animate-fade-in">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Page Header / Navigation Bar --}}
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-200/80 mb-8 flex items-center gap-3">
            <a href="{{ url('/') }}" class="flex h-8 w-8 items-center justify-center rounded-xl bg-slate-100 text-slate-600 hover:bg-red-50 hover:text-[#ED1C24] transition-all font-bold text-sm cursor-pointer shadow-sm">
                &larr;
            </a>
            <h1 class="text-xl font-extrabold text-[#262262] tracking-tight">Create Cargo Booking</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Forms Section --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card 1: Booking Logistics Information --}}
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200/80">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-[#262262] border-b border-slate-100 pb-3 mb-5">Booking Info</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <span class="text-red-500 mr-0.5">*</span>Shipping Method
                            </label>
                            <select name="method"
                                class="w-full text-sm bg-slate-50 border @error('method') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors font-medium">
                                <option value="" {{ !old('method', request('method')) ? 'selected' : '' }}>Select Method</option>
                                <option value="Air" {{ strtolower(old('method', request('method'))) == 'air' ? 'selected' : '' }}>Air Shipping</option>
                                <option value="Sea" {{ strtolower(old('method', request('method'))) == 'sea' ? 'selected' : '' }}>Sea Cargo</option>
                            </select>
                            @error('method')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Generated Shipping Mark</label>
                            <div class="relative">
                                <input type="text" value="{{ auth()->user()?->customer_code ? auth()->user()->customer_code . '-' . date('ymd') : 'SS' . rand(10000, 99999) }}" readonly
                                    class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl pl-4 pr-10 py-3 text-slate-800 font-bold tracking-wider select-none focus:outline-none">
                                <span class="absolute inset-y-0 right-3.5 flex items-center text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 space-y-3.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-0.5">
                            <span class="text-red-500 mr-0.5">*</span>Tracking / Barcode IDs
                        </label>

                        <div>
                            <input type="text" name="tracking[]" placeholder="Enter package tracking ID (e.g. SF18399422)" value="{{ old('tracking.0') }}"
                                class="w-full text-sm bg-slate-50 border @error('tracking.0') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                            @error('tracking.0')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="dynamic-tracking-container" class="space-y-3">
                            @if(old('tracking'))
                                @foreach(old('tracking') as $index => $value)
                                    @if($index > 0)
                                        <div class="flex items-center gap-2 animate-fade-in">
                                            <div class="flex-1">
                                                <input type="text" name="tracking[]" placeholder="Tracking" value="{{ $value }}" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                                            </div>
                                            <button type="button" class="remove-tracking-btn flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:bg-red-50 hover:text-[#ED1C24] hover:border-red-100 transition-colors cursor-pointer shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.34 6.6m-2.57 0L11.34 9m4.86-2.51L16.5 6a2.25 2.25 0 0 0-2.25-2.25h-4.5A2.25 2.25 0 0 0 7.5 6l.16 1.49M20.25 7.5c-.71 1.96-2.14 3.75-4.25 4.95M3.75 7.5c.71 1.96 2.14 3.75 4.25 4.95M12 12v6" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h12M9 3h6" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <button type="button" id="add-tracking-btn"
                        class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-[#262262] hover:text-[#ED1C24] transition-colors cursor-pointer">
                        <span class="text-sm font-black">+</span> Add More Tracking ID
                    </button>
                </div>

                {{-- Card 2: Cargo Item Specifications --}}
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200/80">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-[#262262] border-b border-slate-100 pb-3 mb-5">Item Details</h2>

                    <div class="mb-5 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span class="text-red-500 mr-0.5">*</span>Item Name
                        </label>
                        <input type="text" name="item_name" placeholder="e.g. Smart Watch, Cosmetic Creams, Cotton Shirts" value="{{ old('item_name') }}"
                            class="w-full text-sm bg-slate-50 border @error('item_name') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                        @error('item_name')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span class="text-red-500 mr-0.5">*</span>Product Category
                        </label>
                        <select id="category-select" name="category_id" placeholder="Search By category Name" autocomplete="off"
                            class="w-full text-sm bg-white border @error('category_id') border-red-500 @else border-slate-200 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none">
                            @if(old('category_id') && isset($oldCategory))
                                <option value="{{ old('category_id') }}"
                                        data-sea-price-start="{{ $oldCategory->sea_price_start }}"
                                        data-sea-price-end="{{ $oldCategory->sea_price_end }}"
                                        data-air-price-start="{{ $oldCategory->air_price_start }}"
                                        data-air-price-end="{{ $oldCategory->air_price_end }}"
                                        selected>{{ old('category_name', $oldCategory->name) }}</option>
                            @endif
                        </select>
                        <input type="hidden" name="category_name" id="category_name" value="{{ old('category_name') }}">
                        @error('category_id')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span class="text-red-500 mr-0.5">*</span>Total Carton Pieces
                        </label>
                        <input type="number" name="total_carton" placeholder="e.g. 5" value="{{ old('total_carton') }}"
                            class="w-full text-sm bg-slate-50 border @error('total_carton') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                        @error('total_carton')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <span class="text-red-500 mr-0.5">*</span>Total Quantity (Pieces)
                            </label>
                            <input type="number" name="total_quantity" placeholder="e.g. 150" value="{{ old('total_quantity') }}"
                                class="w-full text-sm bg-slate-50 border @error('total_quantity') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                            @error('total_quantity')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <span class="text-red-500 mr-0.5">*</span>Total Actual Weight (KG)
                            </label>
                            <input type="number" step="0.1" name="total_weight" placeholder="e.g. 12.5" value="{{ old('total_weight') }}"
                                class="w-full text-sm bg-slate-50 border @error('total_weight') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                            @error('total_weight')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5 mt-5">
                        <input type="checkbox" name="sensitive_goods" id="sensitive-goods" value="1" {{ old('sensitive_goods') ? 'checked' : '' }}
                            class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#262262] focus:ring-[#262262]">
                        <label for="sensitive-goods" class="text-xs font-bold text-slate-600 select-none cursor-pointer">This parcel contains sensitive items (e.g. Battery, Liquids, Powders, or Cosmetics).</label>
                    </div>
                </div>

                {{-- Card 3: Doorstep Delivery Settings --}}
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200/80">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-[#262262] border-b border-slate-100 pb-3 mb-5">Delivery Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <span class="text-red-500 mr-0.5">*</span>Delivery Method
                            </label>
                            <select name="delivery_method"
                                class="w-full text-sm bg-slate-50 border @error('delivery_method') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
                                <option value="">Select Delivery Method</option>
                                <option value="Home Delivery" {{ old('delivery_method') == 'Home Delivery' ? 'selected' : '' }}>Home Delivery</option>
                                <option value="Office Pickup" {{ old('delivery_method') == 'Office Pickup' ? 'selected' : '' }}>Office Pickup</option>
                            </select>
                            @error('delivery_method')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <span class="text-red-500 mr-0.5">*</span>Destination District
                            </label>
                            <select id="district-select" name="district_id" placeholder="Select District" autocomplete="off"
                                class="w-full text-sm bg-white border @error('district_id') border-red-500 @else border-slate-200 @enderror rounded-xl text-slate-800 focus:outline-none">
                                @if(old('district_id'))
                                    <option value="{{ old('district_id') }}" selected>{{ old('district_name') }}</option>
                                @endif
                            </select>
                            <input type="hidden" name="district_name" id="district_name" value="{{ old('district_name') }}">
                            @error('district_id')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1.5 mb-5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Full Delivery Address <span class="text-red-500 mr-0.5">*</span>
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter complete delivery street, house, and contact details"
                            class="w-full text-sm bg-slate-50 border @error('address') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors resize-none">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Operational Remarks / Note</label>
                        <textarea name="note" rows="3" placeholder="Enter any instruction or shipping preference for our logistics managers..."
                            class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors resize-none">{{ old('note') }}</textarea>
                    </div>
                </div>

            </div>

            {{-- Summary Sidebar Section --}}
            <div class="space-y-5 lg:sticky lg:top-24">
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-slate-200/80">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-[#262262] border-b border-slate-100 pb-3 mb-5">Summary Billing</h2>

                    <div class="space-y-4 text-sm font-bold text-slate-600 mb-6">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-400 uppercase tracking-wider">Total Weight</span>
                            <span class="font-extrabold text-slate-800"><span id="summary-weight">0</span> KG</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-400 uppercase tracking-wider">Tariff Rate (KG)</span>
                            <span class="font-extrabold text-slate-800"><span id="summary-rate">0</span></span>
                        </div>
                        <div class="flex justify-between items-center text-base font-black text-[#262262] pt-4 border-t border-dashed border-slate-100">
                            <span>Shipping Charge</span>
                            <span class="text-[#ED1C24]"><span id="summary-total">0</span></span>
                        </div>
                    </div>

                    {{-- Warehouse Info Card --}}
                    <div class="bg-blue-50 border border-blue-100/60 rounded-xl p-4 text-center mb-4">
                        <h3 class="text-xs font-extrabold text-[#262262] tracking-widest mb-1.5 uppercase">China Collection Warehouse</h3>
                        <p class="text-xs font-bold text-slate-600 leading-relaxed mb-1.5">{{ settings('address') }}</p>
                        <p class="text-xs font-extrabold text-blue-700">{{ settings('phone') }}</p>
                    </div>

                    {{-- Instruction Card --}}
                    <div class="bg-red-50/60 border border-red-100/60 rounded-xl p-4 text-center mb-5">
                        <h3 class="text-xs font-extrabold text-red-900 mb-1.5 uppercase">Mandatory Rule</h3>
                        <p class="text-[11px] font-bold text-red-700 leading-relaxed">Ensure your packages reach our China warehouse collection center within 7 days of placing this booking.</p>
                    </div>

                    <div class="flex items-start gap-2.5 mb-5">
                        <input type="checkbox" id="terms" required
                            class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#262262] focus:ring-[#262262]">
                        <label for="terms" class="text-xs font-semibold text-slate-500 leading-tight select-none cursor-pointer">
                            I agree to the <a href="{{ route('terms.conditions') }}" class="text-[#262262] font-bold hover:underline">Terms & Conditions</a> and <a href="{{ route('privacy.policy') }}" class="text-[#262262] font-bold hover:underline">Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-extrabold text-sm py-3.5 rounded-xl transition-all shadow-md shadow-red-600/10 hover:shadow-lg focus:outline-none cursor-pointer">
                        Place Booking Manifest
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    let selectedCategory = null;

    // Load initial category from data attributes if selected
    const initialCategoryOption = document.querySelector('#category-select option[selected]');
    if (initialCategoryOption) {
        selectedCategory = {
            id: initialCategoryOption.value,
            name: initialCategoryOption.textContent,
            sea_price_start: initialCategoryOption.getAttribute('data-sea-price-start') || '0',
            sea_price_end: initialCategoryOption.getAttribute('data-sea-price-end') || '0',
            air_price_start: initialCategoryOption.getAttribute('data-air-price-start') || '0',
            air_price_end: initialCategoryOption.getAttribute('data-air-price-end') || '0'
        };
    }

    function updateSummary() {
        const weight = parseFloat(document.querySelector('input[name="total_weight"]').value) || 0;
        document.getElementById('summary-weight').innerText = weight;

        const methodSelect = document.querySelector('select[name="method"]');
        const method = methodSelect ? methodSelect.value.trim().toLowerCase() : '';

        if (!method) {
            document.getElementById('summary-rate').innerText = 'Select method first';
            document.getElementById('summary-total').innerText = 'Select method first';
            return;
        }

        if (selectedCategory) {
            let pStart = 0;
            let pEnd = 0;

            if (method === 'sea') {
                pStart = parseFloat(selectedCategory.sea_price_start) || 0;
                pEnd = parseFloat(selectedCategory.sea_price_end) || 0;
            } else if (method === 'air') {
                pStart = parseFloat(selectedCategory.air_price_start) || 0;
                pEnd = parseFloat(selectedCategory.air_price_end) || 0;
            }

            const rateStr = `${pStart} - ${pEnd}`;
            document.getElementById('summary-rate').innerText = `${rateStr} Tk`;

            const totalStart = pStart * weight;
            const totalEnd = pEnd * weight;
            document.getElementById('summary-total').innerText = `${totalStart.toFixed(2)} - ${totalEnd.toFixed(2)} Tk`;
        } else {
            document.getElementById('summary-rate').innerText = '0 Tk';
            document.getElementById('summary-total').innerText = '0 Tk';
        }
    }

    document.querySelector('input[name="total_weight"]').addEventListener('input', updateSummary);
    document.querySelector('select[name="method"]').addEventListener('change', function() {
        updateSummary();
        if (typeof categorySelect !== 'undefined' && categorySelect) {
            categorySelect.clear();
            categorySelect.clearOptions();
            categorySelect.clearCache();
            categorySelect.load('');
        }
    });

    // Call once on load to initialize values
    updateSummary();

    // Initialize Tom Select for Category
    var categorySelect = new TomSelect("#category-select", {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        preload: true,
        load: function(query, callback) {
            const methodSelect = document.querySelector('select[name="method"]');
            const method = methodSelect ? methodSelect.value.trim().toLowerCase() : '';
            var url = '/api/search-categories?q=' + encodeURIComponent(query) + '&method=' + encodeURIComponent(method);
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    callback(json);
                }).catch(() => {
                    callback();
                });
        },
        onChange: function(value) {
            var item = this.options[value];
            document.getElementById('category_name').value = item ? item.name : '';
            selectedCategory = item;
            updateSummary();
        },
        render: {
            option: function(item, escape) {
                const methodSelect = document.querySelector('select[name="method"]');
                const method = methodSelect ? methodSelect.value.trim().toLowerCase() : '';

                let priceText = '';
                if (method === 'sea') {
                    priceText = escape(item.sea_price_start) + ' - ' + escape(item.sea_price_end) + ' Tk';
                } else if (method === 'air') {
                    priceText = escape(item.air_price_start) + ' - ' + escape(item.air_price_end) + ' Tk';
                } else {
                    priceText = 'Select method first';
                }

                return '<div class="py-1 px-2">' +
                            '<span class="font-medium">' + escape(item.name) + '</span>' +
                            '<span class="text-xs text-slate-500 ml-2">(' + priceText + ')</span>' +
                        '</div>';
            },
            item: function(item, escape) {
                const methodSelect = document.querySelector('select[name="method"]');
                const method = methodSelect ? methodSelect.value.trim().toLowerCase() : '';

                let priceText = '';
                if (method === 'sea') {
                    priceText = escape(item.sea_price_start) + ' - ' + escape(item.sea_price_end) + ' Tk';
                } else if (method === 'air') {
                    priceText = escape(item.air_price_start) + ' - ' + escape(item.air_price_end) + ' Tk';
                } else {
                    priceText = 'Select method first';
                }

                return '<div>' + escape(item.name) + ' (' + priceText + ')</div>';
            }
        }
    });

    // Initialize Tom Select for District
    var districtSelect = new TomSelect("#district-select", {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        preload: true,
        load: function(query, callback) {
            var url = '/api/search-districts?q=' + encodeURIComponent(query);
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    callback(json);
                }).catch(() => {
                    callback();
                });
        },
        onChange: function(value) {
            var item = this.options[value];
            document.getElementById('district_name').value = item ? item.name : '';
        },
        render: {
            option: function(item, escape) {
                return '<div>' + escape(item.name) + '</div>';
            },
            item: function(item, escape) {
                return '<div>' + escape(item.name) + '</div>';
            }
        }
    });

    // Handle removal of initial tracking fields from old data
    document.querySelectorAll('.remove-tracking-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.flex').remove();
        });
    });

    // Prevent scroll on number inputs
    document.addEventListener('wheel', function(event) {
        if (document.activeElement.type === 'number') {
            document.activeElement.blur();
        }
    });

    document.getElementById('add-tracking-btn').addEventListener('click', function() {
        const container = document.getElementById('dynamic-tracking-container');

        // Create a new row
        const fieldRow = document.createElement('div');
        fieldRow.className = 'flex items-center gap-2 animate-fade-in';

        // Input and remove button structure
        fieldRow.innerHTML = `
            <div class="flex-1">
                <input type="text" name="tracking[]" placeholder="Tracking" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#262262] focus:border-[#262262] transition-colors">
            </div>
            <button type="button" class="remove-tracking-btn flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:bg-red-50 hover:text-[#ED1C24] hover:border-red-100 transition-colors cursor-pointer shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.34 6.6m-2.57 0L11.34 9m4.86-2.51L16.5 6a2.25 2.25 0 0 0-2.25-2.25h-4.5A2.25 2.25 0 0 0 7.5 6l.16 1.49M20.25 7.5c-.71 1.96-2.14 3.75-4.25 4.95M3.75 7.5c.71 1.96 2.14 3.75 4.25 4.95M12 12v6" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h12M9 3h6" />
                </svg>
            </button>
        `;

        // Append to container
        container.appendChild(fieldRow);

        // Remove row logic
        fieldRow.querySelector('.remove-tracking-btn').addEventListener('click', function() {
            fieldRow.remove();
        });
    });
</script>
@endsection
