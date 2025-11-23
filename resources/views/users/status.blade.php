@extends('layouts.template')

@section('title', 'My Projects')
@section('main-overflow', 'overflow-y-auto')

@section('content')

    @if (session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-200 px-6 py-4 rounded-lg mb-6 max-w-6xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-linear-to-b from-[#1f2230] via-[#2b2f42] to-[#1f2230] text-white min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6">

            {{-- My Purchases Section --}}
            <p class="text-gray-400 mb-6">Track your orders and download purchased projects</p>

            <div class="space-y-6">
<<<<<<< HEAD
                @forelse ($payments as $purchase)
=======
                @forelse ($purchases as $purchase)
>>>>>>> de2b6997e69300a9248bd708c2caa7fd4e9233fa
                    @php
                        $project = $purchase->project;
                    @endphp

                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition">
                        <div class="grid md:grid-cols-12 gap-10 items-center">
                            {{-- Project Info --}}
                            <div class="md:col-span-4 text-center">
                                @if ($project)
                                    <h3 class="text-xl font-semibold mb-1">{{ $project->judul_project }}</h3>
                                    <p class="text-gray-400 text-sm">
                                        {{ $project->deskripsi_project }}
                                    </p>
                                @else
                                    <h3 class="text-xl font-semibold mb-1 text-gray-500">(Project Deleted)</h3>
                                    <p class="text-gray-500 text-sm">This project is no longer available</p>
                                @endif

                                <p class="text-xs text-gray-500 mt-2">Order: {{ $purchase->order_id }}</p>
                            </div>

                            {{-- Price --}}
                            <div class="md:col-span-2 text-center">
                                <p class="text-sm text-gray-400">Amount Paid</p>
                                <p class="text-lg font-bold text-yellow-400">
                                    Rp {{ number_format($purchase->amount, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Status --}}
                            <div class="md:col-span-2 text-center">
                                <p class="text-sm text-gray-400 mb-2">Status</p>

                                @if ($purchase->status == 'pending')
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-yellow-500/20 text-yellow-400">
                                        Pending
                                    </span>
                                @elseif ($purchase->status == 'paid')
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-500/20 text-green-400">
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-red-500/20 text-red-400">
                                        Rejected
                                    </span>
                                @endif

                                <p class="text-xs text-gray-500 mt-1">{{ $purchase->created_at->format('M d, Y') }}</p>
                            </div>

                            {{-- Action --}}
                            <div class="md:col-span-2">
                                @if ($purchase->status === 'paid' && $purchase->download_link)
                                    <a href="{{ $purchase->download_link }}"
                                       target="_blank"
                                       class="block w-full bg-green-500/20 hover:bg-green-500/30 text-green-400 font-semibold py-3 px-4 rounded-lg transition text-center">
                                        Download
                                    </a>
                                @elseif ($purchase->status === 'paid')
                                    <button disabled
                                        class="block w-full bg-gray-500/20 text-gray-500 font-semibold py-3 px-4 rounded-lg cursor-not-allowed text-center text-sm">
                                        {{ $project->download_link ? $project->download_link : 'Link not available' }}
                                    </button>
                                @elseif ($purchase->status === 'pending')
                                    <button disabled
                                            class="block w-full bg-yellow-500/20 text-yellow-400 font-semibold py-3 px-4 rounded-lg cursor-not-allowed text-center text-sm">
                                        Awaiting Approval
                                    </button>
                                @else
                                    <button disabled
                                            class="block w-full bg-red-500/20 text-red-400 font-semibold py-3 px-4 rounded-lg cursor-not-allowed text-center text-sm">
                                        Payment Failed
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>

                @empty
                    <div class="text-center py-16">
                        <p class="text-gray-400 text-lg mb-4">You haven't purchased any projects yet</p>
                        <button onclick="showSection('available')"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg transition">
                            Browse Projects
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection