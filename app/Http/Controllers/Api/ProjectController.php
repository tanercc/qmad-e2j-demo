<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['data' => Project::all()]);
    }

    public function show(Project $project)
    {
        return response()->json(['data' => $project]);
    }
}
