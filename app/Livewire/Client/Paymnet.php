<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\payments as Payment;
use App\Models\monthly_amortization_table as MonthlyAmortizationTable;
use Illuminate\Support\Facades\Auth;

class Paymnet extends Component
{
    use WithFileUploads;

    public $name;
    public $amount;
    public $receipt;
    public $selectedAmortization;

    public function mount()
    {

        $this->name = Auth::user()->name;
    }

    public function submitPayment()
    {

        $validatedData = $this->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'receipt' => 'required|file|max:1024',
            'selectedAmortization' => 'required|exists:monthly_amortization_tables,id',
        ]);


        $receiptPath = $this->receipt->store('receipts', 'public');


        Payment::create([
            'user_id' => Auth::id(),
            'amortization_id' => $this->selectedAmortization,
            'name' => $this->name,
            'amount' => $this->amount,
            'receipt_path' => $receiptPath,
        ]);


        session()->flash('message', 'Payment submitted successfully.');
        $this->reset(['name', 'amount', 'receipt', 'selectedAmortization']);
    }

    public function render()
    {

        $amortizations = MonthlyAmortizationTable::where('user_id', Auth::id())->get();

        return view('livewire.client.paymnet', [
            'amortizations' => $amortizations,
        ]);
    }
}
