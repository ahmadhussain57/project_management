<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\Project;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('features.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'status'=>'required|string|in:active,inactive',
            'project_id'=>'required|exists:projects,id',
            'frontend'=>'boolean',
            'backend'=>'boolean',
            'DB'=>'boolean',
        ]);

        Feature::create($validation);
        return redirect()->route('projects.show', $request->project_id)->with('success', 'Feature created successfully.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Feature $feature)
    {
        return view('features.show', compact('project','feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Feature $feature)
    {
        return view('features.edit', compact('project','feature'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project, Feature $feature)
    {
        $validation=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'status'=>'required|string|in:active,inactive',
            'project_id'=>'required|exists:projects,id',
            
        ]);


        $feature->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'project_id'=>$request->project_id,
            'frontend'=>$request->has('frontend'),
            'backend'=>$request->has('backend'),
            'DB'=>$request->has('DB'),
        ]);
        return redirect()->route('projects.features.show', [$project, $feature])->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Feature $feature)
    {
        $feature->delete();
        return redirect()->route('projects.show', $project->id)->with('success', 'Feature deleted successfully.');  
    }
}
