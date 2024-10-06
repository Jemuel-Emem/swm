<?php

namespace App\Livewire;

use App\Models\Barangay;
use App\Models\comaplaints;
use Livewire\Component;

class Report extends Component
{
    public $barangay_id;
    public $date_from, $date_to;
    public function render()
    {
        return view('livewire.report',[
            'barangays' => Barangay::get(),
            'complaints' => comaplaints::when($this->barangay_id, function($record){
                $record->where('barangay_id', $this->barangay_id);
            })->when($this->date_from && $this->date_to, function($date){
                $date->whereBetween('violation_date', [$this->date_from, $this->date_to]);
            })->get(),
        ]);
    }
}
