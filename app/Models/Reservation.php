<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'vehicle_id',
        'reserved_by',
        'start_time',
        'end_time',
        'purpose'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function dispatch()
{
    return $this->hasOne(Dispatch::class);
}
}