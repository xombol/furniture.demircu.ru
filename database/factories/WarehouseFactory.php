<?php

namespace Database\Factories;

use App\Enums\WarefouseEnums;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Warehouse>
 */
class WarehouseFactory extends Factory
{

    protected $model = Warehouse::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $warehousesIds = Warehouse::query()->pluck('id');

        return [
            'location' => $this->faker->randomElement($warehousesIds),
        ];
    }
}
