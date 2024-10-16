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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('merchant_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('edition_id')->constrained();
            $table->foreignId('condition_id')->constrained();
            $table->foreignId('transmission_id')->constrained();
            $table->foreignId('engine_id')->constrained();
            $table->foreignId('fuel_id')->constrained();
            $table->foreignId('skeleton_id')->constrained();
            $table->foreignId('mileage_id')->constrained();
            $table->foreignId('grade_id')->constrained();
            $table->year('registration');
            $table->year('manufacture');
            $table->double('price')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->timestamp('publish_at')->nullable();
            $table->boolean('is_feat')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
