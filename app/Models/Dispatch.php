<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'vehicle_id',
        'driver_id',
        'start_location',
        'end_location',
        'route_polyline',
        'dispatch_date',
        'dispatch_time',
        'estimated_arrival',
        'dispatched_at'
    ];

    // Eto ang kulang kaya nag-eerror:
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}