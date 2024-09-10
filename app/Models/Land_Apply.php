<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land_Apply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'address',
        'landmeasurement',
        'price',
        'name',
        'number',
    ];
}
