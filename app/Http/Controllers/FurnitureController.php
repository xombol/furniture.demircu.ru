<?php

namespace App\Http\Controllers;

use App\Enums\StatusesEnums;
use App\Enums\WarefouseEnums;
use App\Models\ActivityFurnitureUpdate;
use App\Models\Furniture;
use App\Models\Warehouse;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    /**
     * List Furnitures
     * @return \Inertia\Response
     */
    public function index()
    {
        $furnitures = Furniture::query()->with(['warehouses', 'colors'])->get();

        return Inertia::render('Furniture/ListFurniture', [
            'furnitures' => $furnitures,
            'warehouses' => WarefouseEnums::cases(),
        ]);
    }


    public function update(Furniture $furniture, Request $request)
    {
        // тут надо прокинуть в job [ обязательно ]

        $warehouseNew = Warehouse::query()->where('location', '=', $request->warehouse)->first();

        $activity = new ActivityFurnitureUpdate();
        $activity->furniture_id = $furniture->id;
        $activity->status = StatusesEnums::SAVED->value;
        $activity->old_field = $furniture->warehouses[0]->location;
        $activity->new_field = $request->warehouse;
        $activity->save();

        $furniture->warehouses()->detach();
        $furniture->warehouses()->attach($warehouseNew);
        $furniture->save();

    }
}
