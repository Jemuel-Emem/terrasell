<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postland extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'location',
        'price',
        'landmeasurement',
        'photo',
        'video',
        'category',


    ];
}
