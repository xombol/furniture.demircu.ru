<?php

use App\Models\Color;
use App\Models\Furniture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('furniture_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Furniture::class)->constrained('furniture')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Color::class)->constrained('colors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_colors');
    }
};
