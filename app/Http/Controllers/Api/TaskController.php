<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TaskResource;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request, Project $project) {
        return TaskResource::collection($project->tasks);
    }

    public function show(Request $request, Project $project, $id) {
        $task = $project->tasks()->where('id', $id)->firstOrFail();
        return new TaskResource($task);
    }
}
