<?php

namespace App\Livewire;

use App\Models\comaplaints;
use Livewire\Component;

class AdminReport extends Component
{
    public $date_from, $date_to;
    public function render()
    {
        return view('livewire.admin-report',[
            'complaints' => comaplaints::where('barangay_id', auth()->user()->barangay->id)->when($this->date_from && $this->date_to, function($date){
                $date->whereBetween('violation_date', [$this->date_from, $this->date_to]);
            })->get(),
        ]);
    }
}
