<?php

namespace App\Livewire\Admin;

use App\Models\Agent;
use App\Models\Landowner;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $userCount;
    public $agentCount;
    public $landownerCount;

    public function mount()
    {

        $this->userCount = User::count();
        $this->agentCount = User::where('is_admin', 2)->count();
        $this->landownerCount = Landowner::count();
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'userCount' => $this->userCount,
            'agentCount' => $this->agentCount,
            'landownerCount' => $this->landownerCount,
        ]);
    }
}
