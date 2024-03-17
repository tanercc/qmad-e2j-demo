<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Resource;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project = Project::updateOrcreate(['id' => 1], ['name' => 'Gantt Project']);

        $contents = File::get(base_path('data/resources.json'));
        $jsonData = json_decode(json: $contents, associative: true);
        foreach ($jsonData as $item) {
            Resource::updateOrcreate(['id' => $item['resourceId']], ['name' => $item['resourceName'],]);
        }

        $contents = File::get(base_path('data/data.json'));
        $jsonData = json_decode(json: $contents, associative: true);
        foreach ($jsonData as $item) {
            $data = $this->convertNames($item);
            $data['project_id'] = $project->id;
            Task::create($data);

            if (isset($item['subtasks'])) {
                foreach ($item["subtasks"] as $subitem) {
                    $data = $this->convertNames($subitem);
                    $data['project_id'] = $project->id;
                    $data['parentID'] = $item['TaskID'];
                    Task::create($data);
                }
            }
        }
    }

    private function convertNames($data) {
        return [
            'taskId' => $data['TaskID'],
            'taskName' => $data['TaskName'],
            'startDate' => $data['StartDate'] ?? null,
            'endDate' => $data['EndDate'] ?? null,
            'duration' => $data['Duration'] ?? null,
            'dependency' => $data['Predecessor'] ?? null,
            'progress' => $data['Progress'] ?? null,
            'resourceInfo' => isset($data['resources']) ? json_encode($data['resources']) : null,
            'notes' => $data['info'] ?? null,
        ];
    }
}
