<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ActivityFurnitureUpdate extends Model
{
    use HasFactory;

    public function furniture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Furniture::class);
    }
}
