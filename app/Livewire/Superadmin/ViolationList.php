<?php

namespace App\Livewire\Superadmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Violation;
use App\Models\User;
use Livewire\Component;

class ViolationList extends Component
{
    public $add_modal = false;
    public $edit_modal = false;
    public $violation_id;
    public $search;
    public $name;

    public function render()
    {
        return view('livewire.superadmin.violation-list', [
            'violations' => Violation::when($this->search, function($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%');
            })->get(),
        ]);
    }

    public function edit($id)
    {
        $this->violation_id = $id;
        $violation = Violation::find($this->violation_id);
        $this->name = $violation->name;

        $this->edit_modal = true;
    }

    public function submitRecord()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        Violation::create([
            'name' => $this->name,
            'user_id' => Auth::id(),
        ]);

        $this->reset(['name']);
        $this->add_modal = false;
    }

    public function updateRecord()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        $violation = Violation::find($this->violation_id);
        $violation->update([
            'name' => $this->name,
            'user_id' => Auth::id(),
        ]);

        $this->edit_modal = false;
    }

    public function delete($id)
    {
        Violation::find($id)->delete();
    }
}
