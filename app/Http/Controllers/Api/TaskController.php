<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Project $project)
    {
        return [
            'Items' => TaskResource::collection($project->tasks),
            'Count' => $project->tasks->count(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $data = $request->all();
        if (is_array($data)) $data = $data[0];
        $data['project_id'] = $project->id;
        $data['resourceInfo'] = isset($data['resourceInfo']) ? json_encode($data['resourceInfo']) : null;
        Task::create($data);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project, $id)
    {
        $task = $project->tasks()->where('id', $id)->firstOrFail();
        return [
            'Item' => new TaskResource($task),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        foreach ($data as $item) {
            $item['project_id'] = $project->id;
            $item['resourceInfo'] = isset($item['resourceInfo']) ? json_encode($item['resourceInfo']) : null;

            $task = Task::where('project_id', $project->id)->where('taskId', $item['taskId'])->first();
            if ($task) {
                $task->update($item);
            }
        }
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, $id)
    {
        $task = $project->tasks()->where('id', $id)->firstOrFail();
        if ($task->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
