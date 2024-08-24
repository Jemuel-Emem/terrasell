<?php

namespace App\Livewire\Agent;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\PostLand as Land;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class PostLand extends Component
{
    use WithFileUploads, Actions, WithPagination;

    public $add_modal = false;
    public $edit_modal = false;
    public $search;

    public $address;
    public $location;
    public $price;
    public $landmeasurement;
    public $photo;
    public $video;
    public $selectedLandId;

    protected $rules = [
        'address' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric',
        'landmeasurement' => 'required|string|max:255',
        'photo' => 'nullable|image|max:1024',
        'video' => 'file|mimetypes:video/mp4,video/mpeg,video/quicktime|max:20480',
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.agent.post-land', [
            'landowner' => Land::where('address', 'like', $search)->paginate(10),
        ]);
    }

    public function addland()
    {

        Log::info('Preparing to validate inputs');

        $validatedData = $this->validate();


        Log::info('Validation passed', $validatedData);


        if ($this->photo) {
            Log::info('Photo upload:', [
                'original_name' => $this->photo->getClientOriginalName(),
                'size' => $this->photo->getSize(),
                'mime_type' => $this->photo->getMimeType(),
            ]);
        }

        if ($this->video) {
            Log::info('Video upload:', [
                'original_name' => $this->video->getClientOriginalName(),
                'size' => $this->video->getSize(),
                'mime_type' => $this->video->getMimeType(),
            ]);
        } else {
            Log::warning('Video file is missing');
        }


        $photoPath = $this->photo ? $this->photo->store('land_photos', 'public') : null;
        $videoPath = $this->video ? $this->video->store('land_videos', 'public') : null;


        Log::info('Photo Path: ' . $photoPath);
        Log::info('Video Path: ' . $videoPath);


        $land = Land::create([
            'address' => $this->address,
            'location' => $this->location,
            'price' => $this->price,
            'landmeasurement' => $this->landmeasurement,
            'photo' => $photoPath,
            'video' => $videoPath,
        ]);


        Log::info('Land created', $land->toArray());


        $this->reset(['address', 'location', 'price', 'landmeasurement', 'photo', 'video']);


        $this->add_modal = false;


        $this->notification([
            'title' => 'Land Added',
            'description' => 'The land details have been successfully added!',
            'icon' => 'success',
        ]);
    }

    public function edit($id)
    {
        $this->selectedLandId = $id;
        $land = Land::findOrFail($id);

        $this->address = $land->address;
        $this->location = $land->location;
        $this->price = $land->price;
        $this->landmeasurement = $land->landmeasurement;

        $this->edit_modal = true;
    }

    public function updateLand()
    {


        $land = Land::findOrFail($this->selectedLandId);

        $land->update([
            'address' => $this->address,
            'location' => $this->location,
            'price' => $this->price,
            'landmeasurement' => $this->landmeasurement,
        ]);


        if ($this->photo) {
            if ($land->photo) {
                Storage::disk('public')->delete($land->photo);
            }
            $photoPath = $this->photo->store('land_photos', 'public');
            $land->update(['photo' => $photoPath]);
        }


        if ($this->video) {
            if ($land->video) {
                Storage::disk('public')->delete($land->video);
            }
            $videoPath = $this->video->store('land_videos', 'public');
            $land->update(['video' => $videoPath]);
        }

        $this->reset(['address', 'location', 'price', 'landmeasurement', 'photo', 'video']);
        $this->edit_modal = false;

        $this->notification([
            'title' => 'Land Updated',
            'description' => 'The land details have been successfully updated!',
            'icon' => 'success',
        ]);
    }

    public function delete($id)
    {

        $land = Land::find($id);

        if ($land) {

            if ($land->photo) {
                Storage::disk('public')->delete($land->photo);
            }


            if ($land->video) {
                Storage::disk('public')->delete($land->video);
            }


            $land->delete();


            $this->notification([
                'title' => 'Land Deleted',
                'description' => 'The land details have been successfully deleted!',
                'icon' => 'success',
            ]);
        } else {

            $this->notification([
                'title' => 'Error',
                'description' => 'Failed to delete land. Land record not found.',
                'icon' => 'error',
            ]);
        }
    }


}
