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
        Schema::create('vehiclestatuses', function (Blueprint $table) {
            $table->id();
             $table->string('name');
        $table->string('plate_number')->unique();
        $table->enum('status', ['Available', 'On Trip', 'Maintenance', 'Reserved'])->default('Available');
        $table->string('driver_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiclestatuses');
    }
};
