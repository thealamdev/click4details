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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->double('budget')->nullable();
            $table->double('ready_budget')->nullable();
            $table->integer('serious')->nullable();
            $table->string('level')->nullable();
            $table->integer('frequency')->nullable();
            $table->string('profession')->nullable();
            $table->double('income')->nullable();
            $table->double('company_transaction')->nullable();
            $table->string('loan')->nullable();
            $table->double('bank_loan')->nullable();
            $table->double('self_pay')->nullable();
            $table->longText('instraction')->nullable();
            $table->longText('location')->nullable();
            $table->date('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
