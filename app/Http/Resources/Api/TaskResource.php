<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "TaskId" => $this->TaskId,
            "TaskName" => $this->TaskName,
            "StartDate" => $this->StartDate,
            "EndDate" => $this->EndDate,
            "TimeLog" => $this->TimeLog,
            "Work" => $this->Work,
            "Progress" => $this->Progress,
            "Status" => $this->Status,
            "ParentId" => $this->ParentId,
            "Assignee" => json_decode($this->Assignee),
            "Priority" => $this->Priority,
            "Component" => $this->Component,
            "Predecessor" => $this->Predecessor,
            "StoryPoints" => $this->StoryPoint
        ];
    }
}
