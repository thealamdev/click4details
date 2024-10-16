<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations
     * @return void
     */
    public function up(): void
    {
        Schema::create('specification_vehicle', function (Blueprint $table) {
            $table->foreignId('specification_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('specification_vehicle');
    }
};
