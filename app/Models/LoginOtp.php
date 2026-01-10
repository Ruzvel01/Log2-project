<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginOtp extends Model
{
    //
      use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expires_at',
    ];

    // Optional: para ma-handle ang expiration timestamp
    protected $dates = ['expires_at'];
}
