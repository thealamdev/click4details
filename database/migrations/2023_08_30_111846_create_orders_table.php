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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment_status')->default('unpaid')->comment('unpaid','paid','partical');
            $table->string('order_status')->default('pending')->comment('pending','processing','complete','cancel');
            $table->double('payment')->nullable();
            $table->double('due')->nullable();
            $table->foreignId('district_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('upazila_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('union_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('mobile');
            $table->longText('area')->nullable();
            $table->double('shipping_charge');
            $table->double('payable_amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
