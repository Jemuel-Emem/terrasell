<?php

namespace App\Livewire\Client;

use App\Models\monthly_amortization_table as MonthlyAmortizationTable;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MonthlyAmortization extends Component
{
    public $amortizations;

    public function mount()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();

        // Retrieve amortization data for the specific user
        $this->amortizations = MonthlyAmortizationTable::where('user_id', $userId)->get();
    }

    public function render()
    {
        return view('livewire.client.monthly-amortization', [
            'amortizations' => $this->amortizations,
        ]);
    }
}
