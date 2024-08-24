<?php

namespace App\Livewire\Admin;
use App\Models\contracts;

use Livewire\Component;

class Contracttosell extends Component
{
    public $sellerName;
    public $sellerDetails;
    public $buyerName;
    public $buyerDetails;
    public $landLocation;
    public $landArea;
    public $phase;
    public $blockNo;
    public $lotNo;
    public $area;

    public function save()
    {


        $this->validate([
            'sellerName' => 'required|string|max:255',
            'sellerDetails' => 'required|string|max:255',
            'buyerName' => 'required|string|max:255',
            'buyerDetails' => 'required|string|max:255',
            'landLocation' => 'required|string|max:255',
            'landArea' => 'required|string|max:255',
            'phase' => 'required|string|max:255',
            'blockNo' => 'required|string|max:255',
            'lotNo' => 'required|string|max:255',
            'area' => 'required|string|max:255',
        ]);


        Contracts::create([
            'SellersName' => $this->sellerName,
            'SellersDetails' => $this->sellerDetails,
            'BuyersName' => $this->buyerName,
            'BuyersDetails' => $this->buyerDetails,
            'LandLocation' => $this->landLocation,
            'LandArea' => $this->landArea,
            'Phase' => $this->phase,
            'BlockNo' => $this->blockNo,
            'LotNo' => $this->lotNo,

        ]);



        $this->reset();


        session()->flash('message', 'Contract saved successfully.');
    }
    public function render()
    {
        return view('livewire.admin.contracttosell');
    }


}
