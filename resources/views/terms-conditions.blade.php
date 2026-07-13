@extends('layouts.frontend')

@section('title', 'Terms & Conditions - ' . settings('app_name', config('app.name')))
@section('meta_description', 'Read our Terms and Conditions.')

@section('content')
<div class="bg-white py-12 shadow-sm rounded-xl border border-gray-100 my-6">
    <div class="container mx-auto px-6 max-w-4xl">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 border-b pb-4">Terms & Conditions</h1>
        <div class="text-gray-700 leading-relaxed text-left whitespace-pre-line">
            {!! nl2br(e($content)) !!}
        </div>
    </div>
</div>
@endsection
