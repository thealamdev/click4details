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
        Schema::create('purchase_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->double('lc_usd')->nullable();
            $table->double('doller_ratelc')->nullable();
            $table->double('lc_taka')->nullable();
            $table->date('lc_date')->nullable();
            $table->double('tt_usd')->nullable();
            $table->double('doller_ratett')->nullable();
            $table->double('tt_taka')->nullable();
            $table->date('tt_date')->nullable();
            $table->double('total_purchaseprice_usd')->nullable();
            $table->double('total_purchase_priceUSDRate')->nullable();
            $table->double('total_taka')->nullable();
            $table->date('purchase_date')->nullable();
            $table->double('port_charge')->nullable();
            $table->date('port_landDate')->nullable();
            $table->double('port_dailyCharge')->nullable();
            $table->date('port_exitDate')->nullable();
            $table->double('total_costing')->nullable();
            $table->double('add_profit')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('add_expenses')->nullable();
            $table->double('transportation_cost')->nullable();
            $table->double('touch_up')->nullable();
            $table->double('parse_accessoy')->nullable();
            $table->double('speed_money')->nullable();
            $table->double('others')->nullable();
            $table->double('cnf_charge')->nullable();
            $table->string('terms_agree')->nullable();
            $table->double('fixed_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_vehicles');
    }
};
