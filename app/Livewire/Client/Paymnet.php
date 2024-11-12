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

    public $mop;
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

        $this->validate([
            'selectedAmortization' => 'required',
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'mop' => 'required',
            'receipt' => $this->mop === 'gcash' ? 'required|file|mimes:jpg,png,pdf' : 'nullable',
        ]);

        $receiptPath = null;
        if ($this->mop === 'gcash' && $this->receipt) {
            $receiptPath = $this->receipt->store('receipts', 'public');
        }


        Payment::create([
            'user_id' => Auth::id(),
            'amortization_id' => $this->selectedAmortization,
            'name' => $this->name,
            'amount' => $this->amount,
            'receipt_path' => $receiptPath,
            'mop'=>$this->mop
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
