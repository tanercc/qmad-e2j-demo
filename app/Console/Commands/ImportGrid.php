<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportGrid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-grid';

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
        $arrayData = [
            ['id' => 1, 'status' => 'Open'],
            ['id' => 2, 'status' => 'Archived'],
            ['id' => 3, 'status' => 'Canceled'],
        ];
        foreach ($arrayData as $data) {
            Status::create($data);
        }

        $contents = File::get(base_path('data/order.json'));
        $jsonData = json_decode(json: $contents, associative: true);
        foreach ($jsonData as $item) {
            $data = $this->convertNames($item);
            Order::create($data);
        }
    }

    private function convertNames($data)
    {
        return [
            "orderID" => $data['OrderID'],
            "customerID" => $data['CustomerID'],
            "orderDate" => $data['OrderDate'],
            "shippedDate" => $data['ShippedDate'] ?? null,
            "freight" => $data['Freight'] ?? null,
            "shipName" => $data['ShipName'] ?? null,
            "shipAddress" => $data['ShipAddress'] ?? null,
            "shipCity" => $data['ShipCity'] ?? null,
            "shipRegion" => $data['ShipRegion'] ?? null,
            "shipCountry" => $data['ShipCountry'] ?? null,
            'status_id' => rand(1, 3)
        ];
    }
}
