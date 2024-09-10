<?php

namespace App\Livewire\Admin;

use App\Models\Land_Apply;
use App\Models\monthly_amortization_table as MonthlyAmortizationTable;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log Facade
use Livewire\Component;

class MonthlyAmortization extends Component
{
    use WithPagination;

    public $add_modal = false;
    public $edit_modal = false;
    public $buyersname, $buyersdetails, $phase, $blockno, $lotno, $area, $monthlypayment, $totalpayment;
    public $buyerId;
    public $buyerNames = [];

    protected $rules = [
        'buyersname' => 'required|exists:land_apply,id',
        'buyersdetails' => 'required|string|max:255',
        'phase' => 'required|string|max:255',
        'blockno' => 'required|string|max:50',
        'lotno' => 'required|string|max:50',
        'area' => 'required|string|max:50',
        'monthlypayment' => 'required|numeric',
        'totalpayment' => 'required|numeric',
    ];

    public function mount()
    {

        $this->buyerNames = Land_Apply::where('status', 'approved')
                                       ->pluck('name', 'name')
                                       ->toArray();
    }



    public function render()
    {
        $buyers = MonthlyAmortizationTable::paginate(10);
        return view('livewire.admin.monthly-amortization', [
            'buyers' => $buyers,
            'buyerNames' => $this->buyerNames,
        ]);
    }

    public function addBuyer()
    {

        $userId = Land_Apply::where('name', $this->buyersname)->value('user_id');

    if (!$userId) {
        session()->flash('error', 'User ID not found for the selected buyer.');
        return;
    }


    MonthlyAmortizationTable::create([
        'user_id' => $userId,
        'buyersname' => $this->buyersname,
        'buyersdetails' => $this->buyersdetails,
        'phase' => $this->phase,
        'blockno' => $this->blockno,
        'lotno' => $this->lotno,
        'area' => $this->area,
        'monthlypayment' => $this->monthlypayment,
        'totalpayment' => $this->totalpayment,
    ]);
        $this->resetFields();
        $this->add_modal = false;
        session()->flash('message', 'Buyer added successfully.');
    }

    public function edit($id)
    {
        $buyer = MonthlyAmortizationTable::findOrFail($id);
        $this->buyerId = $buyer->id;
        $this->buyersname = $buyer->buyersname;
        $this->buyersdetails = $buyer->buyersdetails;
        $this->phase = $buyer->phase;
        $this->blockno = $buyer->blockno;
        $this->lotno = $buyer->lotno;
        $this->area = $buyer->area;
        $this->monthlypayment = $buyer->monthlypayment;
        $this->totalpayment = $buyer->totalpayment;
        $this->edit_modal = true;
    }

    public function updateBuyer()
    {
        $this->validate();
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
        $this->resetFields();
        $this->edit_modal = false;
        session()->flash('message', 'Buyer updated successfully.');
    }

    public function delete($id)
    {
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
