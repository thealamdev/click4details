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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('merchant_id')->constrained();
            $table->foreignId('priceunit_id')->constrained();
            $table->foreignId('sizeunit_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->double('land_size');
            $table->longText('address')->nullable();
            $table->boolean('negotiable');
            $table->bigInteger('priority')->default(1);
            $table->string('code');
            $table->double('price')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->timestamp('publish_at')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
