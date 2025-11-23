@extends('layouts.template')
@section('title', 'Checkout')

@section('main-overflow', 'overflow-y-auto')

@section('content')
    <div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white py-20 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            {{-- Error message display --}}
            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-6 py-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-200 px-6 py-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-5xl font-extrabold tracking-tight mb-2">Checkout</h1>
            <p class="text-gray-300 mb-12">Complete the payment for your selected project.</p>

            <div class="grid lg:grid-cols-3 gap-10">

                {{-- LEFT FORM --}}
                <div class="lg:col-span-2 bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-2xl">
                    <h2 class="text-xl font-semibold mb-6">Payment Information</h2>

                    <form action="{{ route('payments.paymentByProject', $project->id) }}" method="POST">
                        @csrf

                        {{-- Hidden input for project --}}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm text-gray-400">Full Name</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                    class="w-full mt-1 bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                    required>
                                @error('customer_name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm text-gray-400">Email</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                    class="w-full mt-1 bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                    required>
                                @error('customer_email')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- BCA Payment Instructions --}}
                        <div class="mt-8 bg-yellow-400/10 border border-yellow-400/30 rounded-xl p-6">
                            <h3 class="text-yellow-400 font-semibold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Payment Instructions
                            </h3>
                            <p class="text-gray-300 text-sm mb-3">Please send payment to:</p>
                            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-400 mb-1">BCA Account Number</p>
                                        <p class="text-2xl font-bold text-yellow-400 tracking-wider">6733109641</p>
                                    </div>
                                    <button type="button" onclick="copyToClipboard('6733109641')" 
                                        class="bg-yellow-400/20 hover:bg-yellow-400/30 text-yellow-400 px-4 py-2 rounded-lg text-sm transition">
                                        Copy
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-3">After payment, click submit below to confirm your order.</p>
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-4 rounded-lg transition">
                                Submit Payment
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RIGHT: Order Summary --}}
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-2xl h-fit">
                    <h2 class="text-xl font-semibold mb-6">Order Summary</h2>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-400">Project</p>
                            <p class="font-semibold">{{ $project->judul_project }}</p>
                        </div>

                        <div class="border-t border-white/10 pt-4">
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-400">Price</p>
                                <p class="text-2xl font-bold text-yellow-400">Rp {{ number_format($project->project_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Account number copied to clipboard!');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection