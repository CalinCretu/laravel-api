<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $technologies = Technology::orderBy('name', 'ASC')->get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|max:30|min:2|string',
            'description' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'status' => 'required',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'

        ]);

        $data = $request->all();

        $project = Project::create($data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($data['technologies']);
        }


        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $technologies = Technology::orderBy('name', 'ASC')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validate([
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ]);

        $data = $request->all();

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
