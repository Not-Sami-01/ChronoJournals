<?php

namespace App\Livewire;

use App\Models\AppUsers;
use Livewire\Component;

class Admin extends Component
{
    // public $id;
    public $username;
    public $password;
    // public $status;
    public function editUser($id){
        $user = AppUsers::find($id);
        $this->username? $user->username = $this->username: null; 
        $this->password? $user->password = $this->password: null;
        // $this->status? $user->status = $this->status: null;
        $user->save();
        // dd($this->all(), $id);
        session()->flash('success', 'Edit operation was successful');
        return $this->redirect('/admin', navigate:true);
    }

    public function render()
    {
        $users = AppUsers::get()->all();
        $data = compact('users');
        return view('livewire.admin')->with($data);
    }
}
