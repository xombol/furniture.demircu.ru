<?php

use App\Enums\StatusesEnums;
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
        Schema::create('activity_furniture_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Furniture::class)->constrained('furniture')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->default(StatusesEnums::NEW->value);
            $table->string('old_field');
            $table->string('new_field');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_furniture_updates');
    }
};
