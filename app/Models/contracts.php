<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contracts extends Model
{
    use HasFactory;

    protected $fillable = [
        'SellersName',
        'SellersDetails',
        'BuyersName',
        'BuyersDetails',
        'LandLocation',
        'LandArea',
        'Phase',
        'BlockNo',
        'LotNo',

    ];
}
