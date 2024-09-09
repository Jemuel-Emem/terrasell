<?php

namespace App\Livewire\Admin;

use App\Models\Land_Apply as Property_Applicant;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyApplication extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // You can specify the pagination theme if needed.

    public function approve($applicationId)
    {
        $application = Property_Applicant::find($applicationId);

        if ($application) {
            $application->status = 'approved';
            $application->save();

            session()->flash('message', 'Application approved successfully.');
        }
    }

    public function decline($applicationId)
    {
        $application = Property_Applicant::find($applicationId);

        if ($application) {
            $application->status = 'declined';
            $application->save();

            session()->flash('message', 'Application declined successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.property-application', [
            'applications' => Property_Applicant::paginate(5) // Paginate by 5
        ]);
    }
}
