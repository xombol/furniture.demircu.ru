<?php

namespace Database\Factories;

use App\Models\Furniture;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Furniture>
 */
class FurnitureFactory extends Factory
{

    protected $model = Furniture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }


    public function attachWarehouses(): FurnitureFactory|Factory
    {
        $warehouses = Warehouse::query()->get();

        return $this->afterCreating(function (Furniture $furniture) use ($warehouses) {
            // Присоединение складов к мебели
            $furniture->warehouses()->attach($this->faker->randomElement($warehouses));
        });
    }
}
