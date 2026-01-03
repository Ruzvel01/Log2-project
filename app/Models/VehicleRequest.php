<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_model',
        'vehicle_type',
        'quantity',
        'purpose',
        'status',
    ];
}
