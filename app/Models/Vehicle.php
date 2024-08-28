<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'license_plate',
        'fuel_type',
        'status',
        'client_id',
        'picture',
        'insurer_id'
    ];
}
