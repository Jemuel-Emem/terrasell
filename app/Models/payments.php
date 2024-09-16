<?php

namespace App\Models;

use App\Livewire\Admin\MonthlyAmortization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amortization_id',
        'name',
        'amount',
        'receipt_path',
        'status',
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Amortization
    public function amortization()
    {
        return $this->belongsTo(monthly_amortization_table::class, 'amortization_id');
    }
}
