<?php

namespace App\Livewire\Client;

use App\Models\PostLand;
use App\Models\Land_Apply;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Land extends Component
{
    use WithPagination;

    public $search;
    public $apply_modal = false; // For modal visibility
    public $selected_land = []; // To hold selected land data

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.client.land', [
            'land' => PostLand::where('location', 'like', $search)->paginate(10),
        ]);
    }

    public function find()
    {
        // This will rerender the view
        $this->render();
    }

    public function applyNow($landId)
    {
        // Find the selected land by its ID
        $land = PostLand::find($landId);

        // Check if the land exists to avoid errors
        if ($land) {
            // Set the selected land details
            $this->selected_land = [
                'location' => $land->location,
                'address' => $land->address,
                'landmeasurement' => $land->landmeasurement,
                'price' => $land->price,
            ];

            // Open the modal
            $this->apply_modal = true;
        } else {
            // Handle case when land is not found
            $this->addError('selected_land', 'Land not found.');
        }
    }

    public function submitApplication()
    {

        // Ensure the user is authenticated
        $user = Auth::user();

        if ($user && $this->selected_land) {
            // Save the application details in the Land_Apply table
            Land_Apply::create([
                'user_id' => $user->id,
                'location' => $this->selected_land['location'],
                'address' => $this->selected_land['address'],
                'landmeasurement' => $this->selected_land['landmeasurement'],
                'price' => $this->selected_land['price'],
                'name' => $user->name, // Using the authenticated user's name
                'number' => $user->number, // Assuming 'number' is a field in the User model
            ]);

            // Optionally add a success message or notification
            session()->flash('message', 'Application submitted successfully.');

            // Reset the modal and selected land data
            $this->apply_modal = false;
            $this->selected_land = [];
        } else {
            // Handle cases when user is not authenticated or land is missing
            $this->addError('application', 'Unable to submit application. Please try again.');
        }
    }
}
