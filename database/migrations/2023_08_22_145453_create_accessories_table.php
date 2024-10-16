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
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('purchase_from');
            $table->foreignId('accessory_brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id');
            $table->double('purchase_price');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('merchant_id')->constrained();
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('accessories');
    }
};
