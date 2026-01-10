<?php

// app/Models/Vehicle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
      'plate_no',
    'model',
    'type',
    'status',
    'engine_no',
    'chassis_no',
    'color',
    'fuel_type',
    'transmission',
    'registration_expiry',
    ];

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}
public function dispatch()
{
    return $this->hasOne(Dispatch::class);
}
}
