<?php

namespace App\Livewire\Client;

use App\Models\Payments;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PaymentHistory extends Component
{
    public function render()
    {
        // Fetch payments of the logged-in user
        $payments = Payments::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('livewire.client.payment-history', compact('payments'));
    }
}
