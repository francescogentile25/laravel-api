<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::with('type:id,name', 'type.projects', 'technologies')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
    public function show($slug)
    {
        $project = Project::with('type:name,slug,id', 'technologies:name,slug,id')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun progetto presente'
            ]);
        }
    }
}
