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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
              $table->string('plate_no')->unique();
    $table->string('model');
    $table->string('type');
    $table->string('status')->default('Available');
    // Mga bagong fields:
    $table->string('engine_no')->nullable();
    $table->string('chassis_no')->nullable();
    $table->string('color')->nullable();
    $table->string('fuel_type')->nullable(); // Diesel, Gasoline, etc.
    $table->string('transmission')->nullable(); // Manual, Automatic
    $table->date('registration_expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
