<?php

namespace App\Livewire\User;

use App\Models\comaplaints;
use Livewire\Component;

class ComplainStatus extends Component
{
    public function render()
    {
        return view('livewire.user.complain-status',[
            'complaints' => comaplaints::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
