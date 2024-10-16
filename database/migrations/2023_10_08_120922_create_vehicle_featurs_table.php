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
        Schema::create('vehicle_featurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('slug');
            $table->foreignId('edition_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('featur_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('detail_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_featurs');
    }
};
