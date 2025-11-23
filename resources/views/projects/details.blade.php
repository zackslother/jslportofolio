@extends('layouts.template')
@section('title', 'Project Details')

@section('main-overflow', 'overflow-y-hidden')

@section('content')
<div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white py-5 min-h-screen">

    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

        {{-- LEFT: Project Info --}}
        <div>
            <p class="text-yellow-400 text-sm tracking-widest uppercase mb-3">
                Project Details
            </p>

            <h1 class="text-5xl font-extrabold leading-tight mb-4">
                {{ $projects->judul_project }}
            </h1>

            {{-- Created/Updated --}}
            <div class="flex gap-6 text-gray-300 text-sm mb-6">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($projects->created_at)->format('F d, Y') }}
                </span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Updated {{ \Carbon\Carbon::parse($projects->updated_at)->diffForHumans() }}
                </span>
            </div>

            {{-- Description --}}
            <p class="text-lg text-gray-300 leading-relaxed mb-10">
                {{ $projects->deskripsi_project }}
            </p>

            {{-- Price --}} 
            <div class="bg-white/5 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/10 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Project Price</p>
                        <p class="text-4xl font-extrabold text-yellow-400">Rp. {{ $projects->project_price }}</p>
                    </div>
                    <div class="text-right">
                        <div class="flex flex-col justify-center items-center">
                            <p class="text-sm text-gray-400 mb-1">Status</p>
                            <span class="inline-block bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm font-semibold">
                                Available
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="grid gap-3">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 px-6 rounded-lg transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        
                        <a href="/payments/checkout/{{ $projects->id }}" class="text-black">Checkout</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
