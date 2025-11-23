@extends('layouts.template')
@section('title', 'Payment Submitted')

@section('content')
    <div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white py-20 min-h-screen flex items-center justify-center">
        <div class="max-w-2xl mx-auto px-6 text-center">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-20 rounded-2xl shadow-2xl">            
                {{-- Success Icon --}}
                <div class="mb-6 flex justify-center">
                    <div class="bg-green-500/20 rounded-full p-6">
                        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-extrabold tracking-tight mb-4">Payment Submitted!</h1>
                
                <p class="text-gray-300 text-lg mb-8">
                    Thank you for your submission. We will review your payment proof and get back to you shortly.
                </p>
            </div>
        </div>
    </div>
@endsection