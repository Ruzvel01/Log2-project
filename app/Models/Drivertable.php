<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Drivertable extends Model
{
    //
        use HasFactory;

    protected $fillable = ['name', 'email', 'is_active'];
}
