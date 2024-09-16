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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // The user making the payment
            $table->unsignedBigInteger('amortization_id');  // The amortization being paid for
            $table->string('name');  // Name of the payer
            $table->decimal('amount', 10, 2);  // Amount paid
            $table->string('receipt_path');  // Path to the uploaded receipt
            $table->string('status')->default('pending');  // Name of the payer


            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('amortization_id')->references('id')->on('monthly_amortization_tables')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
