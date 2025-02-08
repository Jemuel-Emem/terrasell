<?php

namespace App\Livewire\Client;

use App\Models\PostLand;
use App\Models\Land_Apply;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Land extends Component
{
    use WithPagination;
   use Actions;
    public $search;
    public $apply_modal = false;
    public $selected_land = [];
    public $booking_date;
    public function render()
    {
        $search = '%' . $this->search . '%';

        return view('livewire.client.land', [
            'land' => PostLand::where('location', 'like', $search)
                             ->orWhere('address', 'like', $search)
                             ->orWhere('price', 'like', $search)
                             ->orWhere('landmeasurement', 'like', $search)
                             ->paginate(10),
        ]);
    }


    public function find()
    {

        $this->render();
    }

    public function applyNow($landId)
    {
        $land = PostLand::find($landId);

        if ($land) {
            $this->selected_land = [
                'location' => $land->location,
                'address' => $land->address,
                'landmeasurement' => $land->landmeasurement,
                'price' => $land->price,
            ];

            $this->apply_modal = true;


        } else {
            $this->addError('selected_land', 'Land not found.');
        }
    }


    public function submitApplication()
    {


        $user = Auth::user();

        if ($user && $this->selected_land) {

            Land_Apply::create([
                'user_id' => $user->id,
                'location' => $this->selected_land['location'],
                'address' => $this->selected_land['address'],
                'landmeasurement' => $this->selected_land['landmeasurement'],
                'price' => $this->selected_land['price'],
                'name' => $user->name,
                'number' => $user->number,
                'appointment_schedule' =>$this->booking_date,
            ]);

            $this->notification()->success(
                $title = 'Book Application !',
                $description = 'Application submitted successfully.'
            );



            $this->apply_modal = false;
            $this->selected_land = [];
        } else {

            $this->addError('application', 'Unable to submit application. Please try again.');
        }
    }
}
