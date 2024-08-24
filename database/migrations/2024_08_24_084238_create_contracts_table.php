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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('SellersName')->nullable();
            $table->text('SellersDetails')->nullable();
            $table->string('BuyersName');
            $table->text('BuyersDetails')->nullable();
            $table->string('LandLocation')->nullable();
            $table->string('LandArea')->nullable();
            $table->string('Phase')->nullable();
            $table->string('BlockNo')->nullable();
            $table->string('LotNo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
