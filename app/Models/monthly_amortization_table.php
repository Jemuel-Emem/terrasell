<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monthly_amortization_table extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'user_id',
        'buyersname',
        'buyersdetails',
        'phase',
        'blockno',
        'lotno',
        'area',
        'monthlypayment',
        'totalpayment',
        'totalfee',
    ];
}
