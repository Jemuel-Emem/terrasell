<?php

namespace App\Livewire\Admin;

use App\Models\payments;
use App\Models\monthly_amortization_table as MonthlyAmortizationTable;
use Livewire\Component;

class Payment extends Component
{
    public function approvePayment($paymentId)
    {
        $payment = payments::find($paymentId);
        if ($payment) {

            $payment->status = 'approved';
            $payment->save();


            $amortization = MonthlyAmortizationTable::find($payment->amortization_id);
            if ($amortization) {

                $amortization->totalfee = $amortization->totalfee + $payment->amount;

                $amortization->totalpayment = $amortization->totalpayment - $payment->amount;
                $amortization->save();
            }
        }

    }

    public function declinePayment($paymentId)
    {
        $payment = payments::find($paymentId);
        if ($payment) {

            $payment->status = 'declined';
            $payment->save();
        }
    }

    public function render()
    {

        $payments = payments::paginate(10);

        return view('livewire.admin.payment', [
            'payments' => $payments,
        ]);
    }
}
