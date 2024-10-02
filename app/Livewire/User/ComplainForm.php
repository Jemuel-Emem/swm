<?php

namespace App\Livewire\User;

use App\Models\Comaplaints;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class ComplainForm extends Component
{
    use WithFileUploads, Actions;
    use WithFileUploads;

    public $barangay, $violation, $violation_date, $violation_time, $proof;

    protected $rules = [
        'barangay' => 'required|string',
        'violation' => 'required|string',
        'violation_date' => 'required|date',
        'violation_time' => 'required',
        'proof' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ];

    public function submitComplaint()
    {

        $this->validate();


        $proofPath = $this->proof->store('complaint_proofs', 'public');


        Comaplaints::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'barangay' => $this->barangay,
            'violation' => $this->violation,
            'violation_date' => $this->violation_date,
            'violation_time' => $this->violation_time,
            'proof' => $proofPath,
        ]);

        $this->notification()->success(
            $title = 'Complaint Submitted',
            $description = 'Your complaint has been successfully submitted.'
        );


        $this->reset(['barangay', 'violation', 'violation_date', 'violation_time', 'proof']);
    }

    public function render()
    {
        return view('livewire.user.complain-form');
    }
}
