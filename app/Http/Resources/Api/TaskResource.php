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
            "taskId" => $this->taskId,
            "taskName" => $this->taskName,
            "startDate" => $this->startDate,
            "endDate" => $this->endDate,
            "dependency" => $this->dependency,
            "duration" => $this->duration,
            "durationUnit" => $this->durationUnit,
            "progress" => $this->progress,
            "baselineStartDate" => $this->baselineStartDate,
            "baselineEndDate" => $this->baselineEndDate,
            "expandState" => $this->expandState,
            "indicators" => $this->indicators,
            "manual" => $this->manual,
            "milestone" => $this->milestone,
            "notes" => $this->notes,
            "resourceInfo" => json_decode($this->resourceInfo),
            "segmentId" => $this->segmentId,
            "segments" => $this->segments,
            "type" => $this->type,
            "work" => $this->work,
            "cssClass" => $this->cssClass,
            "parentID" => $this->parentID,
        ];
    }
}
