<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Payment;

use App\Http\Requests\StoreProjectRequest;

class ProjectsController extends Controller
{
    /**
     * Re-routes link
     */
    public function about() {
        return view('projects.about');
    }

    public function projects() {
        $currentSessionId = session()->getId();
        
        // Get project IDs that current session has already been requested
        $purchasedProjectIds = Payment::where('session_id', $currentSessionId)
            ->pluck('project_id')
            ->toArray();
        
        // Get all projects except the ones already purchased
        $projects = Projects::whereNotIn('id', $purchasedProjectIds)->get();
        
        return view('projects.projects', [
            'projects' => $projects,
            'title' => 'Projects list',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.home', [
            'title' => 'Projects list',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        return view('projects.details', [
            'projects' => $project,
            'title' => 'Projects details',
        ]);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreProjectRequest $request)
    // {
    //     $Projects = Projects::create($request->validated());
    //     return redirect()->route('projects.index')->with('success', 'Projects was stored successfully');
    // }
}
