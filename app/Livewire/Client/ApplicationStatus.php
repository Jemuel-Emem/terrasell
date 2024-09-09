<?php

namespace App\Livewire\Client;

use App\Models\Land_Apply as ApplicationStatusModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApplicationStatus extends Component
{
    public function render()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's application status
        $applications = ApplicationStatusModel::where('user_id', $user->id)->get();

        return view('livewire.client.application-status', [
            'applications' => $applications,
        ]);
    }
}
