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
        Schema::create('detail_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('edition_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('featur_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('detail_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_features');
    }
};
