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
        Schema::create('merchant_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->longText('address')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->string('company_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_infos');
    }
};
