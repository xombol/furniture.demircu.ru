<?php

namespace App\Http\Controllers;

use App\Models\ActivityFurnitureUpdate;
use Inertia\Inertia;
use Inertia\Response;

class ActivityFurnitureController extends Controller
{
    public function index(): Response
    {
        $activity = ActivityFurnitureUpdate::query()->with('furniture')->get();

        return Inertia::render('Furniture/ListFurnitureActivity', [
            'activities' => $activity,
        ]);
    }
}
