<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalProjects = Projects::count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        $paidPayments = Payment::where('status', 'paid')->count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        
        $payments = Payment::with('project')->orderBy('created_at', 'desc')->get();
        $projects = Projects::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'totalProjects' => $totalProjects,
            'pendingPayments' => $pendingPayments,
            'paidPayments' => $paidPayments,
            'totalRevenue' => $totalRevenue,
            'payments' => $payments,
            'projects' => $projects,
        ]);
    }

    /**
     * Show create project form
     */
    public function createProject()
    {
        return view('admin.projects.create', [
            'title' => 'Create Project',
        ]);
    }

    /**
     * Store new project
     */
    public function storeProject(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_project')) {
            $validated['image_project'] = $request->file('image_project')->store('projects', 'public');
        }

        Projects::create($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show edit project form
     */
    public function editProject(Projects $project)
    {
        return view('admin.projects.edit', [
            'title' => 'Edit Project',
            'project' => $project,
        ]);
    }

    /**
     * Update project
     */
    public function updateProject(UpdateProjectRequest $request, Projects $project)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_project')) {
            if ($project->image_project && Storage::disk('public')->exists($project->image_project)) {
                Storage::disk('public')->delete($project->image_project);
            }

            $validated['image_project'] = $request->file('image_project')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project
     */
    public function destroyProject(Projects $project)
    {
        $project->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Approve payment
     */
    public function approvePayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => 'paid']);

        $payment->user->purchases()->firstOrCreate([
            'user_id'    => $payment->user_id,
            'project_id' => $payment->project_id,
            'payment_id' => $payment->id,
        ], [
            'purchased_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Payment approved successfully!');
    }

    /**
     * Reject payment
     */
    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => 'rejected']);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Payment rejected.');
    }

    /**
     * Delete payment
     */
    public function destroyPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Payment deleted successfully.');
    }
}