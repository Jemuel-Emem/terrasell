<?php

namespace App\Livewire\Client;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\PostLand ;
use Livewire\WithFileUploads;
use Livewire\Component;

class Land extends Component
{
    public $search;
    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.client.land', [
            'land' => PostLand::where('location', 'like', $search)->paginate(10),
        ]);

    }

    public function find(){
   $this->render();
    }
}
