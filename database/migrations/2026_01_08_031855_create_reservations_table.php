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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
                $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
    $table->string('reserved_by');
    $table->dateTime('start_time');
    $table->dateTime('end_time');
    $table->string('purpose')->nullable();
      $table->string('status')->default('Reserved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};