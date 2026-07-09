@extends('layouts.frontend')

@section('title', 'Home - Best Product Service')
@section('meta_description', 'This is the SEO optimized home page description.')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
            border-color: #e5e7eb !important;
        }
        .ts-wrapper.focus .ts-control {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
            border-color: #3b82f6 !important;
        }
    </style>
@endpush

@section('content')
<form action="{{ route('customer.booking.store') }}" method="POST" class="bg-gray-50 py-5">
    @csrf
    <div class="container mx-auto px-4 max-w-7xl">

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3 animate-fade-in">
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-6 flex items-center gap-2">
            <span
                class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-gray-700 text-gray-700 font-bold text-xs">
                &larr;
            </span>
            <h1 class="text-lg font-bold text-gray-800">Create Booking</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-sm font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Booking Info</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                    class="text-red-500 mr-0.5">*</span>Method</label>
                            <select name="method"
                                class="w-full text-sm bg-gray-50 border @error('method') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="Air" {{ (old('method', request('method')) == 'Air' || old('method', request('method')) == 'air') ? 'selected' : '' }}>Air</option>
                                <option value="Sea" {{ (old('method', request('method')) == 'Sea' || old('method', request('method')) == 'sea') ? 'selected' : '' }}>Sea</option>
                            </select>
                            @error('method')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Shipping Mark</label>
                            <div class="relative">
                                <input type="text" value="SS19399" readonly
                                    class="w-full text-sm bg-gray-50 border border-gray-200 rounded-lg pl-3 pr-10 py-2 text-gray-700 font-medium focus:outline-none">
                                <span class="absolute inset-y-0 right-3 flex items-center text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 space-y-3">
                        <label class="block text-xs font-semibold text-gray-600 mb-0.5"><span
                                class="text-red-500 mr-0.5">*</span>Tracking</label>

                        <div>
                            <input type="text" name="tracking[]" placeholder="Tracking" value="{{ old('tracking.0') }}"
                                class="w-full text-sm bg-white border @error('tracking.0') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
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
                                                <input type="text" name="tracking[]" placeholder="Tracking" value="{{ $value }}" class="w-full text-sm bg-white border border-gray-200 rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                            </div>
                                            <button type="button" class="remove-tracking-btn flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-colors">
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
                        class="mt-2 inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 hover:text-blue-600 transition-colors">
                        <span class="text-sm">+</span> Add More Tracking
                    </button>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Item Details</h2>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                class="text-red-500 mr-0.5">*</span>Item Name</label>
                        <input type="text" name="item_name" placeholder="Item Name" value="{{ old('item_name') }}"
                            class="w-full text-sm bg-white border @error('item_name') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        @error('item_name')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                class="text-red-500 mr-0.5">*</span>Category</label>
                        <select id="category-select" name="category_id" placeholder="Search By category Name" autocomplete="off"
                            class="w-full text-sm bg-white border @error('category_id') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            @if(old('category_id'))
                                <option value="{{ old('category_id') }}" selected>{{ old('category_name') }}</option>
                            @endif
                        </select>
                        <input type="hidden" name="category_name" id="category_name" value="{{ old('category_name') }}">
                        @error('category_id')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                class="text-red-500 mr-0.5">*</span>Total Carton</label>
                        <input type="number" name="total_carton" placeholder="Carton" value="{{ old('total_carton') }}"
                            class="w-full text-sm bg-white border @error('total_carton') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        @error('total_carton')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                    class="text-red-500 mr-0.5">*</span>Total Quantity</label>
                            <input type="number" name="total_quantity" placeholder="Quantity" value="{{ old('total_quantity') }}"
                                class="w-full text-sm bg-white border @error('total_quantity') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            @error('total_quantity')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                    class="text-red-500 mr-0.5">*</span>Total Weight</label>
                            <input type="number" name="total_weight" placeholder="Weight" value="{{ old('total_weight') }}"
                                class="w-full text-sm bg-white border @error('total_weight') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            @error('total_weight')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-start gap-2 mt-4">
                        <input type="checkbox" name="sensitive_goods" id="sensitive-goods" value="1" {{ old('sensitive_goods') ? 'checked' : '' }}
                            class="mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="sensitive-goods" class="text-xs font-medium text-gray-600 select-none">This product is a battery, liquid, or cosmetic type.</label>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Delivery Information
                    </h2>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                    class="text-red-500 mr-0.5">*</span>Delivery Method</label>
                            <select name="delivery_method"
                                class="w-full text-sm bg-white border @error('delivery_method') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">Select Delivery Method</option>
                                <option value="Home Delivery" {{ old('delivery_method') == 'Home Delivery' ? 'selected' : '' }}>Home Delivery</option>
                                <option value="Office Pickup" {{ old('delivery_method') == 'Office Pickup' ? 'selected' : '' }}>Office Pickup</option>
                            </select>
                            @error('delivery_method')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5"><span
                                    class="text-red-500 mr-0.5">*</span>District</label>
                            <select id="district-select" name="district_id" placeholder="Select District" autocomplete="off"
                                class="w-full text-sm bg-white border @error('district_id') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
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



                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Address <span
                                class="text-red-500 mr-0.5">*</span></label>
                        <textarea name="address" rows="3" placeholder="Address"
                            class="w-full text-sm bg-white border @error('address') border-red-500 @else border-gray-200 @enderror rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 resize-none">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Note</label>
                        <textarea name="note" rows="3" placeholder="Note"
                            class="w-full text-sm bg-white border border-gray-200 rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 resize-none">{{ old('note') }}</textarea>
                    </div>
                </div>

            </div>

            <div class="space-y-4 lg:sticky lg:top-24">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-sm font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Summary</h2>

                    <div class="space-y-3 text-xs font-medium text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Weight</span>
                            <span class="font-bold text-gray-800"><span id="summary-weight">0</span> Kg</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Rate</span>
                            <span class="font-bold text-gray-800"><span id="summary-rate">0</span> Tk</span>
                        </div>
                        <div
                            class="flex justify-between text-sm font-bold text-gray-800 pt-2 border-t border-dashed border-gray-100">
                            <span>Total Shipping Charge</span>
                            <span><span id="summary-total">0</span> Tk</span>
                        </div>
                    </div>

                    <div class="bg-blue-50/60 border border-blue-100 rounded-xl p-4 text-center mb-4">
                        <h3 class="text-xs font-bold text-blue-900 tracking-wider mb-1">WAREHOUSE ADDRESS</h3>
                        <p class="text-xs font-medium text-gray-700 leading-relaxed mb-1">{{ settings('address') }}</p>
                        <p class="text-xs font-bold text-blue-700">{{ settings('phone') }}</p>
                    </div>

                    <div class="bg-red-50/60 border border-red-100 rounded-xl p-4 text-center mb-4">
                        <h3 class="text-xs font-bold text-red-900 mb-1">Instructions</h3>
                        <p class="text-[11px] font-medium text-red-700 leading-relaxed">Please send the package to our warehouse address within 7 days of booking.</p>
                    </div>

                    <div class="flex items-start gap-2 mb-4">
                        <input type="checkbox" id="terms"
                            class="mt-0.5 h-3.5 w-3.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="terms" class="text-[11px] text-gray-500 leading-tight select-none">
                            I have read and agreed to the <a href="#" class="text-blue-600 hover:underline">Terms &
                                Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2.5 rounded-lg transition-colors duration-200 shadow-lg shadow-blue-600/10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Place Booking
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    let selectedCategory = null;

    function updateSummary() {
        const weight = parseFloat(document.querySelector('input[name="total_weight"]').value) || 0;
        document.getElementById('summary-weight').innerText = weight;

        if (selectedCategory) {
            const rateStr = `${selectedCategory.price_start} - ${selectedCategory.price_end}`;
            document.getElementById('summary-rate').innerText = rateStr;

            const totalStart = selectedCategory.price_start * weight;
            const totalEnd = selectedCategory.price_end * weight;
            document.getElementById('summary-total').innerText = `${totalStart.toFixed(2)} - ${totalEnd.toFixed(2)}`;
        } else {
            document.getElementById('summary-rate').innerText = '0';
            document.getElementById('summary-total').innerText = '0';
        }
    }

    document.querySelector('input[name="total_weight"]').addEventListener('input', updateSummary);

    // Initialize Tom Select for Category
    var categorySelect = new TomSelect("#category-select", {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        preload: true,
        load: function(query, callback) {
            var url = '/api/search-categories?q=' + encodeURIComponent(query);
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
                return '<div class="py-1 px-2">' + 
                            '<span class="font-medium">' + escape(item.name) + '</span>' +
                            '<span class="text-xs text-gray-500 ml-2">(' + escape(item.price_start) + ' - ' + escape(item.price_end) + ' Tk)</span>' +
                        '</div>';
            },
            item: function(item, escape) {
                return '<div>' + escape(item.name) + ' (' + escape(item.price_start) + ' - ' + escape(item.price_end) + ')</div>';
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
                <input type="text" name="tracking[]" placeholder="Tracking" class="w-full text-sm bg-white border border-gray-200 rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>
            <button type="button" class="remove-tracking-btn flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-colors">
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
