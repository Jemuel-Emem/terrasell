<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landowner extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'number',
        'address',
        'location',
        'price',
        'landmeasurement',
        'photo'
    ];
}
