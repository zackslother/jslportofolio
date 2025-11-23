@extends('layouts.template')

@section('title', 'Example App - Home')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white py-20 min-h-screen">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">
            {{-- LEFT --}}
            <div>
                <p class="text-yellow-400 text-sm tracking-widest uppercase mb-3">
                    Hello, I am
                </p>

                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight">
                    Jeremy Sebasthian Lauwono
                </h1>

                <p class="text-lg text-gray-300 mt-5 leading-relaxed max-w-xl">
                    I'm a Roblox game developer and informatics engineering student
                    with a passion for building interactive systems, gameplay mechanics,
                    and intuitive software solutions.
                </p>

                {{-- Counters --}}
                <div class="flex gap-16 mt-10">

                    <div class="text-center">
                        <p class="text-yellow-400 text-5xl font-extrabold">
                            2
                        </p>
                        <p class="text-gray-300 text-sm tracking-wide mt-2 uppercase">
                            Years Experience
                        </p>
                    </div>

                    <div class="text-center">
                        <p class="text-yellow-400 text-5xl font-extrabold">
                            17
                        </p>
                        <p class="text-gray-300 text-sm tracking-wide mt-2 uppercase">
                            Satisfied Clients
                        </p>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Skills --}}
            <div class="bg-white/5 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white/10">
                <h3 class="text-xl mb-6 font-semibold tracking-wide">My Skills</h3>

                <div class="flex flex-wrap gap-3">
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">PHP</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">Python</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">Lua</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">Java</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">JavaScript</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">HTML</span>
                    <span class="skill-tag px-3 py-1 bg-white text-black rounded-full text-sm hover:opacity-100 transition-opacity duration-500">CSS</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 0.9;
                transform: translateY(0);
            }
        }
        
        .skill-tag {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }
        
        .skill-tag:nth-child(1) { animation-delay: 0.1s; }
        .skill-tag:nth-child(2) { animation-delay: 0.2s; }
        .skill-tag:nth-child(3) { animation-delay: 0.3s; }
        .skill-tag:nth-child(4) { animation-delay: 0.4s; }
        .skill-tag:nth-child(5) { animation-delay: 0.5s; }
        .skill-tag:nth-child(6) { animation-delay: 0.6s; }
        .skill-tag:nth-child(7) { animation-delay: 0.7s; }
    </style>
@endsection
