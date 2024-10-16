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
        Schema::create('rent_cars', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('carmodel_id')->constrained();
            $table->foreignId('color_id')->constrained();
            $table->string('vehicle_status')->nullable();
            $table->integer('seat')->nullable();
            $table->string('ac')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->double('daily_charge_inside_dhaka')->nullable();
            $table->double('daily_max_visit_inside')->nullable();
            $table->double('extra_charge_perkm_daily_inside')->nullable();

            $table->double('daily_charge_outside_dhaka')->nullable();
            $table->double('daily_max_visit_outside')->nullable();
            $table->double('extra_charge_perkm_daily_outside')->nullable();

            $table->double('monthly_charge_inside_dhaka')->nullable();
            $table->double('monthly_max_visit_inside')->nullable();
            $table->double('extra_charge_perkm_monthly_inside')->nullable();

            $table->double('monthly_charge_outside_dhaka')->nullable();
            $table->double('monthly_max_visit_outside')->nullable();
            $table->double('extra_charge_perkm_monthly_outside')->nullable();
            $table->string('mileages');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_cars');
    }
};
