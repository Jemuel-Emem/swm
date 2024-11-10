<?php

namespace App\Livewire;

use App\Models\Barangay;
use Livewire\Component;

class Map extends Component
{
    public $markers = [];

    public $barangays;

    public function mount(){
     $this->barangays = Barangay::withCount('complaints')->get();
    }
    public function render()
    {
        return view('livewire.map');
    }
}
