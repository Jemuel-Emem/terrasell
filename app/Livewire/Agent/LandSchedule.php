<?php

namespace App\Livewire\Agent;

use App\Models\Land_Apply;
use Livewire\Component;

class LandSchedule extends Component
{
    public function render()
    {

        $landApplies = Land_Apply::latest()->get();

        return view('livewire.agent.land-schedule', [
            'landApplies' => $landApplies,
        ]);
    }
}
