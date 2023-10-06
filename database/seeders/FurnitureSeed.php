<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Furniture;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnitureSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Furniture::factory()->count(10)
            ->has(Color::factory()->count(2), 'colors')
            ->has(Warehouse::factory()->count(1), 'warehouses')
            ->create();
    }
}
