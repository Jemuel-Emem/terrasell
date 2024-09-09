<?php

namespace App\Livewire\Admin;
use App\Models\monthly_amortization_table as MonthlyAmortizationTable;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MonthlyAmortization extends Component
{use WithPagination;

    public $add_modal = false;
    public $edit_modal = false;

    // Form fields
    public $buyersname, $buyersdetails, $phase, $blockno, $lotno, $area, $monthlypayment, $totalpayment;

    // ID for editing
    public $buyerId;

    protected $rules = [
        'buyersname' => 'required|string|max:255',
        'buyersdetails' => 'required|string|max:255',
        'phase' => 'required|string|max:255',
        'blockno' => 'required|string|max:50',
        'lotno' => 'required|string|max:50',
        'area' => 'required|string|max:50',
        'monthlypayment' => 'required|numeric',
        'totalpayment' => 'required|numeric',
    ];

    public function render()
    {
        $buyers = MonthlyAmortizationTable::paginate(10);
        return view('livewire.admin.monthly-amortization', ['buyers' => $buyers]);
    }

    public function addBuyer()
    {
        $this->validate();

        // Create new buyer
        MonthlyAmortizationTable::create([
            'user_id'=>Auth::user()->id,
            'buyersname' => $this->buyersname,
            'buyersdetails' => $this->buyersdetails,
            'phase' => $this->phase,
            'blockno' => $this->blockno,
            'lotno' => $this->lotno,
            'area' => $this->area,
            'monthlypayment' => $this->monthlypayment,
            'totalpayment' => $this->totalpayment,
        ]);

        // Reset form fields
        $this->resetFields();
        $this->add_modal = false;
        session()->flash('message', 'Buyer added successfully.');
    }

    public function edit($id)
    {
        $buyer = MonthlyAmortizationTable::findOrFail($id);

        // Set form fields with buyer data
        $this->buyerId = $buyer->id;
        $this->buyersname = $buyer->buyersname;
        $this->buyersdetails = $buyer->buyersdetails;
        $this->phase = $buyer->phase;
        $this->blockno = $buyer->blockno;
        $this->lotno = $buyer->lotno;
        $this->area = $buyer->area;
        $this->monthlypayment = $buyer->monthlypayment;
        $this->totalpayment = $buyer->totalpayment;

        // Open edit modal
        $this->edit_modal = true;
    }

    public function updateBuyer()
    {
        $this->validate();

        // Update the buyer
        $buyer = MonthlyAmortizationTable::findOrFail($this->buyerId);
        $buyer->update([
            'buyersname' => $this->buyersname,
            'buyersdetails' => $this->buyersdetails,
            'phase' => $this->phase,
            'blockno' => $this->blockno,
            'lotno' => $this->lotno,
            'area' => $this->area,
            'monthlypayment' => $this->monthlypayment,
            'totalpayment' => $this->totalpayment,
        ]);

        // Reset form fields
        $this->resetFields();
        $this->edit_modal = false;
        session()->flash('message', 'Buyer updated successfully.');
    }

    public function delete($id)
    {
        // Delete buyer record
        MonthlyAmortizationTable::findOrFail($id)->delete();
        session()->flash('message', 'Buyer deleted successfully.');
    }

    private function resetFields()
    {
        $this->buyersname = '';
        $this->buyersdetails = '';
        $this->phase = '';
        $this->blockno = '';
        $this->lotno = '';
        $this->area = '';
        $this->monthlypayment = '';
        $this->totalpayment = '';
    }
}
