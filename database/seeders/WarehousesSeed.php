<?php

namespace Database\Seeders;

use App\Enums\WarefouseEnums;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehousesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::query()->create([
            'location' => WarefouseEnums::Warehouse1->value,
        ]);

        Warehouse::query()->create([
            'location' => WarefouseEnums::Warehouse2->value,
        ]);
    }
}
