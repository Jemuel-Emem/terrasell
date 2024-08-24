<?php

namespace App\Livewire\Admin;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Storage;
use App\Models\landowner as land;
use Livewire\Component;

class Landowner extends Component
{
    use WithFileUploads, Actions, WithPagination;
    public $add_modal = false;
    public $edit_modal = false;
    public $search, $name, $number, $address, $username, $password, $accounttype, $agent_id;
    public $firstname, $lastname, $location, $price, $land_measurements, $photo, $landowner_id;
    public function render()
    {
        $search = '%' .$this->search. '%';
        return view('livewire.admin.landowner',[
            'landowner' => land::where('firstname', 'like', $search)->paginate(10),
        ]);

    }

    public $photoPreview;

    public function updatedPhoto()
    {
        $this->photoPreview = $this->photo->temporaryUrl();
    }


    public function addlandowner()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'number' => 'required',
            'address' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'land_measurements' => 'required',
            'photo' => 'required|image|max:1024',
        ]);

        $photoPath = $this->photo->store('photos', 'public');

       land::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'number' => $this->number,
            'address' => $this->address,
            'location' => $this->location,
            'price' => $this->price,
            'landmeasurement' => "$this->land_measurements",
            'photo' => $photoPath,
        ]);

        $this->notification()->success(
            $title = 'Data saved!',
            $description = 'The landowner details were saved successfully'
        );

        $this->add_modal = false;
        $this->reset(['firstname', 'lastname', 'number', 'address', 'location', 'price', 'land_measurements', 'photo']);
    }

    public function edit($id)
    {
        $landowner = Land::findOrFail($id);

        $this->landowner_id = $landowner->id;
        $this->firstname = $landowner->firstname;
        $this->lastname = $landowner->lastname;
        $this->number = $landowner->number;
        $this->address = $landowner->address;
        $this->location = $landowner->location;
        $this->price = $landowner->price;
        $this->land_measurements = $landowner->landmeasurement;
        $this->photoPreview = Storage::url($landowner->photo);

        $this->edit_modal = true;
    }

    public function updateLandowner()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'number' => 'required',
            'address' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'land_measurements' => 'required',
            'photo' => 'nullable|image|max:1024',
        ]);

        $landowner = Land::findOrFail($this->landowner_id);

        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
            $landowner->photo = $photoPath;
        }

        $landowner->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'number' => $this->number,
            'address' => $this->address,
            'location' => $this->location,
            'price' => $this->price,
            'landmeasurement' => $this->land_measurements,
        ]);

        $this->notification()->success(
            $title = 'Data updated!',
            $description = 'The landowner details were updated successfully'
        );

        $this->edit_modal = false;
        $this->reset(['firstname', 'lastname', 'number', 'address', 'location', 'price', 'land_measurements', 'photo', 'photoPreview', 'landowner_id']);
    }

    public function delete($id)
    {
        $landowner = Land::findOrFail($id);
        $landowner->delete();
        $this->notification()->success(
            $title = 'Data deleted!',
            $description = 'The landowner details were deleted successfully'
        );

        $this->render();
    }
}
