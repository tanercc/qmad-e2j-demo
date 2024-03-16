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
            $data = [
                'project_id' => $project->id,
                'Assignee' => isset($item['Assignee']) ? json_encode($item['Assignee']) : null
            ];
            Task::create(array_merge($item, $data));
        }
    }
}
