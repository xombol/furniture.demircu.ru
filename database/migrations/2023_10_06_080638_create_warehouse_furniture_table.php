<?php

use App\Models\Furniture;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouse_furniture', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Furniture::class)->constrained('furniture')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Warehouse::class)->constrained('warehouses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_furniture');
    }
};
