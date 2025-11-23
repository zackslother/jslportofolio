@extends('layouts.template')
@section('title', 'Edit Project')

@section('main-overflow', 'overflow-y-auto')

@section('content')
    <div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-6">

            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 hover:text-yellow-300 inline-flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-4xl font-extrabold">Edit Project</h1>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Project Title</label>
                            <input type="text" name="judul_project" value="{{ old('judul_project', $project->judul_project) }}"
                                class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                required>
                            @error('judul_project')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Description</label>
                            <textarea name="deskripsi_project" rows="5"
                                class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                required>{{ old('deskripsi_project', $project->deskripsi_project) }}</textarea>
                            @error('deskripsi_project')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Price (Rp)</label>
                            <input type="number" name="project_price" value="{{ old('project_price', $project->project_price) }}" min="0"
                                class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                required>
                            @error('project_price')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Download link</label>
                            <input type="text" name="download_link" value="{{ old('download_link', $project->download_link) }}" min="0"
                                class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400"
                                required>
                            @error('download_link')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Project Image</label>
                            @if($project->image_project)
                                <img src="{{ asset('storage/' . $project->image_project) }}" alt="{{ $project->judul_project }}" class="w-32 h-32 object-cover rounded-lg mb-3">
                            @endif
                            <input type="file" name="image_project" accept="image/*"
                                class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-yellow-400">
                            <p class="text-xs text-gray-500 mt-1">Max size: 2MB (JPG, PNG). Leave empty to keep current image.</p>
                            @error('image_project')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <button type="submit"
                            class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 rounded-lg transition">
                            Update Project
                        </button>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex-1 bg-white/10 hover:bg-white/20 text-white font-semibold py-3 rounded-lg transition text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection