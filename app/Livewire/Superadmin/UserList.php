<?php

namespace App\Livewire\Superadmin;
use App\Models\Barangay;
use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $add_modal = false;
    public $edit_modal = false;

    public $search;

    public $user_id;

    public $name, $email, $password, $confirm_password;

    public function render()
    {
        return view('livewire.superadmin.user-list', [
            'users' =>  User::when($this->search, function($record){
                return $record->where('name', 'LIKE', '%'.$this->search.'%');
            })->get()
        ]);
    }

    public function edit($id){
        $this->user_id = $id;
        $data = User::find($this->user_id);
        $this->name = $data->name;
        $this->email = $data->email;
       
        $this->edit_modal = true;
    }

    public function submitRecord(){
        $this->validate([
            'name' =>'required|string',
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

      

        $this->reset(['name', 'email', 'password', 'confirm_password']);
        $this->add_modal = false;
    }

    public function updateRecord(){
      
        $data = User::find($this->user_id);
        $data->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password == null ? $data->password : bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'password', 'confirm_password']);

        $this->edit_modal = false;
    }

    public function delete($id){
        User::find($id)->delete();
    }
}
