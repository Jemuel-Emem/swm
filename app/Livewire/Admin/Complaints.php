<?php

namespace App\Livewire\Admin;

use App\Models\Barangay;
use App\Models\comaplaints as Complaintss;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Complaints extends Component
{
    public $complaints;

    public function mount()
    {
        $this->loadComplaints();
    }

    public function loadComplaints()
    {

        $barangay = Barangay::where('user_id', auth()->user()->id)->first();


        if ($barangay) {
            $this->complaints = Complaintss::where('barangay_id', $barangay->id)->orderBy('created_at', 'DESC')->get();
        } else {
            $this->complaints = [];
        }
    }

    public function acceptComplaint($id)
    {
//butngan nalang guro status sa tbale no? para di nata mag create another table for accepted complaints?
        $complaint = Complaintss::find($id);
        if ($complaint) {

            $complaint->update(['status' => 'accepted']);
            $this->loadComplaints();
        }
    }

    public function declineComplaint($id)
    {

        $complaint = Complaintss::find($id);
        if ($complaint) {
            $complaint->update(['status' => 'declined']);
            $this->loadComplaints();
        }
    }

    public function render()
    {
        return view('livewire.admin.complaints');
    }
}
