<?php

namespace App\Livewire\User;

use App\Models\Barangay;
use App\Models\Comaplaints;
use App\Models\violation;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class ComplainForm extends Component
{
    use WithFileUploads, Actions;
    use WithFileUploads;

    public $barangay, $violation, $violation_date, $violation_time, $proof;

    public $barangays;
    public $coordinates = [13.9312, 121.6173];

    protected $rules = [
        'barangay' => 'required|string',
        'violation' => 'required|string',
        'violation_date' => 'required|date',
        'violation_time' => 'required',
        'proof' => 'required|image|mimes:jpg,jpeg,png|max:2050',
    ];

    public function mount()
    {
        // Fetch barangay data with names and coordinates
        $this->barangays = Barangay::withCount('complaints')->get();
    }

    public function submitComplaint()
    {

        $this->validate();


        $proofPath = $this->proof->store('complaint_proofs', 'public');


        Comaplaints::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'barangay_id' => Barangay::where('name', 'like', '%'. $this->barangay. '%')->first()->id,
            'violation' => $this->violation,
            'violation_date' => $this->violation_date,
            'violation_time' => $this->violation_time,
            'proof_image' => $proofPath,
        ]);

        $this->notification()->success(
            $title = 'Complaint Submitted',
            $description = 'Your complaint has been successfully submitted.'
        );


        $this->reset(['barangay', 'violation', 'violation_date', 'violation_time', 'proof']);
        return redirect()->route('complaints');
    }

    

    public function render()
    {
        return view('livewire.user.complain-form', [
            'violations' => Violation::get(),
        ]);
    }

}
