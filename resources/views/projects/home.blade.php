@extends('layouts.template')

@section('title', 'Example App - Home')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="relative bg-linear-to-b from-[#1f2230] via-[#2b2f42] to-[#1f2230] text-white py-24 min-h-screen">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-6">

                <p class="text-yellow-400 text-xs tracking-widest uppercase">
                    • Introductions
                </p>

                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                    College student and developer,<br>
                    <span class="text-yellow-300">based in Indonesia</span>
                </h1>

                <p class="text-gray-300 leading-relaxed max-w-md">
                    - "A passionate programmer are essentialy hard workers"
                </p>
            </div>


            <div class="relative">

                <div class="bg-white/5 border border-white/10 backdrop-blur-md 
                            rounded-3xl h-72 flex items-center justify-center
                            text-xl font-semibold tracking-wide shadow-2xl
                            hover:scale-[1.02] transition transform">
                    FOTO DAN DESKRIPSI
                </div>

                <div class="absolute inset-0 -z-10 blur-3xl opacity-20 bg-yellow-300"></div>
            </div>
        </div>
    </div>
@endsection
