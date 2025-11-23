@extends('layouts.template')

@section('title', 'Example App - Home')

@section('main-overflow', 'overflow-y-auto')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="relative bg-linear-to-b from-[#1f2230] via-[#2b2f42] to-[#1f2230] text-white min-h-screen">
        {{-- Projects Section --}}
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold">My Projects</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
                @foreach($projects as $project)
                    <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-6 hover:scale-105 transition transform shadow-xl">
                        
                        @if($project->image_project)
                            <div class="flex justify-center items-center">
                                <img src="{{ Storage::url($project->image_project) }}" 
                                alt="{{ $project->judul_project }}" 
                                class="w-full h-48 object-cover max-w-md"> 
                            </div>
                        @else
                            <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                        @endif

                        <h3 class="text-xl font-semibold mb-2">{{ $project->judul_project }}</h3>
                        
                        <p class="text-gray-300 text-sm mb-4 line-clamp-3">{{ $project->deskripsi_project }}</p>
                        
                        <div class="text-xs text-gray-400 mb-4">
                            <p>Created: {{ \Carbon\Carbon::parse($project->created_at)->format('M d, Y') }}</p>
                        </div>

                        <a href="/projects/{{ $project->id }}" class="block w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded-lg transition duration-300 text-center">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>

            @if($projects->isEmpty())
                <p class="text-center text-gray-400 py-10">No projects available yet.</p>
            @endif
        </div>
    </div>
@endsection