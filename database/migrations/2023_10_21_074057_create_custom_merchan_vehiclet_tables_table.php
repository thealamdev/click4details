<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_merchan_vehiclet_tables', function (Blueprint $table) {
            $table->id();
            $table->boolean('app')->default(true);
            $table->foreignId('merchant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('sl')->default(true);
            $table->boolean('brand_id')->default(true);
            $table->boolean('carmodel_id')->default(true);
            $table->boolean('manufacture')->default(true);
            $table->boolean('registration')->default(true);
            $table->boolean('condition_id')->default(true);
            $table->boolean('edition_id')->default(true);
            $table->boolean('fuel_id')->default(true);
            $table->boolean('mileage_id')->default(true);
            $table->boolean('grade_id')->default(true);
            $table->boolean('feature')->default(true);
            $table->boolean('purchase_price')->default(true);
            $table->boolean('price')->default(true);
            $table->boolean('fixed_price')->default(true);
            $table->boolean('available_id')->default(true);
            $table->boolean('slug')->default(false);
            $table->boolean('skeleton_id')->default(false);
            $table->boolean('power')->default(false);
            $table->boolean('chassis_number')->default(false);
            $table->boolean('engine_number')->default(false);
            $table->boolean('link')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('action')->default(false);
            $table->boolean('modified')->default(false);
            $table->boolean('code')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_merchan_vehiclet_tables');
    }
};
