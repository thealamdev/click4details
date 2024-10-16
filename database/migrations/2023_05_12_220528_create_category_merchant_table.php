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
        Schema::create('category_merchant', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained();
            $table->foreignId('merchant_id')->constrained();
            $table->string('started_at')->nullable();
            $table->string('expired_at')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('category_merchant');
    }
};
