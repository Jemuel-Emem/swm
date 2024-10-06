<?php

namespace App\Livewire;

use App\Models\Barangay;
use Livewire\Component;

class Map extends Component
{
    public $markers = [];

    public function mount(){
        $this->markers = Barangay::withCount('complaints')
        ->get(['id', 'latitude', 'longitude', 'name'])
        ->map(function ($marker) {
            return [
                'id' => $marker->id,
                'latitude' => $marker->latitude,
                'longitude' => $marker->longitude,
                'name' => $marker->name,
                'complaints_count' => $marker->complaints_count,
            ];
        });
    }
    public function render()
    {
        return view('livewire.map');
    }
}
