<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::with('type', 'technologies')->paginate(9);
        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }

    public function show(Project $project)
    {
        $project = Project::with('type', 'technologies')->where('slug', $project->slug)->get();
        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }
}
