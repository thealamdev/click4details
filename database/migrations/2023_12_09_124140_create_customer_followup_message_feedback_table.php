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
        Schema::create('customer_followup_message_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('customer_followup_message_id')->constrained('customer_followup_messages')->onDelete('cascade')->onUpdate('cascade')->index('cfm_id_index')->nullable();
            $table->longText('message')->nullable();
            $table->dateTime('set_time')->nullable();
            $table->double('budget')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_followup_message_feedback');
    }
};
