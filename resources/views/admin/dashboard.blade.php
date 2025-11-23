{{-- admin/dashboard.blade.php --}}
@extends('layouts.template')
@section('title', 'Admin Dashboard')

@section('main-overflow', 'overflow-y-auto')

@section('content')
    <div class="bg-linear-to-br from-[#1e1f29] via-[#3a3f58] to-[#1e1f29] text-white min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <div class="mb-12">
                <h1 class="text-5xl font-extrabold tracking-tight mb-2">Admin Dashboard</h1>
                <p class="text-gray-300">Manage projects and payments</p>
            </div>

            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-200 px-6 py-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-6 py-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Stats Cards --}}
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm mb-2">Total Projects</p>
                    <p class="text-3xl font-bold text-yellow-400">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm mb-2">Pending Payments</p>
                    <p class="text-3xl font-bold text-yellow-400">{{ $pendingPayments }}</p>
                </div>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm mb-2">Paid Orders</p>
                    <p class="text-3xl font-bold text-green-400">{{ $paidPayments }}</p>
                </div>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm mb-2">Total Revenue</p>
                    <p class="text-3xl font-bold text-green-400">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="mb-8">
                <div class="flex gap-4 border-b border-white/10">
                    <button onclick="showTab('payments')" id="paymentsTab" 
                        class="tab-button px-6 py-3 font-semibold border-b-2 border-yellow-400 text-yellow-400">
                        Payments
                    </button>
                    <button onclick="showTab('projects')" id="projectsTab" 
                        class="tab-button px-6 py-3 font-semibold border-b-2 border-transparent text-gray-400 hover:text-white">
                        Projects
                    </button>
                </div>
            </div>

            {{-- Payments Tab Content --}}
            <div id="paymentsContent" class="tab-content">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h2 class="text-2xl font-bold">Payment Orders</h2>
                        <p class="text-gray-400 text-sm mt-1">Manage customer payments</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Project</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse($payments as $payment)
                                    <tr class="hover:bg-white/5">
                                        <td class="px-6 py-4 text-sm font-mono">{{ $payment->order_id }}</td>
                                        <td class="px-6 py-4">
                                            <p class="font-semibold">{{ $payment->customer_name }}</p>
                                            <p class="text-xs text-gray-400">{{ $payment->customer_email }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($payment->project)
                                                <p class="text-sm">{{ $payment->project->judul_project }}</p>
                                            @else
                                                <p class="text-xs text-gray-500">(Deleted Project)</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-yellow-400">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($payment->status == 'pending')
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400">Pending</span>
                                            @elseif($payment->status == 'paid')
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">Paid</span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-400">
                                            {{ $payment->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                @if($payment->status == 'pending')
                                                    <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500/20 hover:bg-green-500/30 text-green-400 px-3 py-1 rounded text-xs font-semibold transition">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-400 px-3 py-1 rounded text-xs font-semibold transition">
                                                            Reject
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this payment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-gray-500/20 hover:bg-gray-500/30 text-gray-400 px-3 py-1 rounded text-xs font-semibold transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                            No payments found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Projects Tab Content --}}
            <div id="projectsContent" class="tab-content hidden">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Projects Management</h2>
                        <p class="text-gray-400 text-sm mt-1">Add, edit, or delete projects</p>
                    </div>
                    <a href="{{ route('admin.projects.create') }}" 
                        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg transition">
                        + Add New Project
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($projects as $project)
                        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition transform">
                            <div class="flex flex-col justify-center items-center">
                                @if($project->image_project)
                                    <img src="{{ Storage::url($project->image_project) }}" 
                                        alt="{{ $project->judul_project }}" 
                                        class="w-full h-48 object-cover max-w-md"> 
                                @else
                                    <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">
                                        No Image
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-2">{{ $project->judul_project }}</h3>
                                    <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $project->deskripsi_project }}</p>
                                    
                                    <p class="text-yellow-400 font-bold text-lg mb-4">
                                        Rp {{ number_format($project->project_price, 0, ',', '.') }}
                                    </p>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                        class="flex-1 bg-yellow-400/20 hover:bg-yellow-400/30 text-yellow-400 text-center px-4 py-2 rounded-lg text-sm font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500/20 hover:bg-red-500/30 text-red-400 px-4 py-2 rounded-lg text-sm font-semibold transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>   

                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-400">
                            No projects found
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active state from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-yellow-400', 'text-yellow-400');
                button.classList.add('border-transparent', 'text-gray-400');
            });

            // Show selected tab content
            document.getElementById(tabName + 'Content').classList.remove('hidden');

            // Add active state to selected tab
            document.getElementById(tabName + 'Tab').classList.remove('border-transparent', 'text-gray-400');
            document.getElementById(tabName + 'Tab').classList.add('border-yellow-400', 'text-yellow-400');
        }
    </script>
@endsection