<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::paginate(20);
        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }
}
