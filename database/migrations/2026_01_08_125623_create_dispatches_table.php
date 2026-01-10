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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
    $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
    $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
    $table->string('start_location');
    $table->string('end_location');
    $table->text('route_polyline')->nullable();
    
    // Idagdag ang mga ito:
    $table->date('dispatch_date')->nullable();
    $table->time('dispatch_time')->nullable();
    $table->dateTime('estimated_arrival')->nullable(); // Estimated Date & Time
    
    $table->timestamp('dispatched_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
