<?php

namespace App\Livewire\Admin;
use App\Models\contracts;
use Livewire\Component;

class ContractList extends Component
{
 public $add_modal=false;
    public $contracts;

    public function mount()
    {

        $this->contracts = contracts::all();
    }
    public function render()
    {
        return view('livewire.admin.contract-list');
    }
}
