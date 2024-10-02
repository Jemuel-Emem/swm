<?php

namespace App\Livewire\Superadmin;

use App\Models\Barangay;
use App\Models\User;
use Livewire\Component;


class BarangayList extends Component
{
    public $add_modal = false;
    public $edit_modal = false;
    public $barangay_id;

    public $search;

    public $name, $longitude, $latitude, $email, $password, $confirm_password;
    public function render()
    {
        return view('livewire.superadmin.barangay-list',[
            'barangays' => Barangay::when($this->search, function($record){
                return $record->where('name', 'LIKE', '%'.$this->search.'%');
            })->get(),
        ]);
    }

    public function edit($id){
        $this->barangay_id = $id;
        $data = Barangay::find($this->barangay_id);
        $this->name = $data->name;
        $this->longitude = $data->longitude;
        $this->latitude = $data->latitude;
        $this->edit_modal = true;
    }

    public function submitRecord(){
        $this->validate([
            'name' =>'required|string',
            'longitude' =>'required|numeric',
            'latitude' =>'required|numeric',
            'email' =>'required|email|unique:users',
            'password' =>'required',
            'confirm_password' =>'required|same:password',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 2,
        ]);

        $barangay = Barangay::create([
            'name' => $this->name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'user_id' => $user->id,
        ]);

        $this->reset(['name', 'longitude', 'latitude', 'email', 'password', 'confirm_password']);
        $this->add_modal = false;
    }

    public function updateRecord(){
        $this->validate([
            'name' =>'required|string',
            'longitude' =>'required|numeric',
            'latitude' =>'required|numeric',
        ]);

        $data = Barangay::find($this->barangay_id);
        $data->update([
            'name' => $this->name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ]);

        $this->edit_modal = false;
    }

    public function delete($id){
        Barangay::find($id)->delete();
    }
}
