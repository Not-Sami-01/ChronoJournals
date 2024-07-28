<?php

namespace App\Livewire;

use App\Models\AppUsers;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function authenticate(){
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = AppUsers::where('username', '=', $this->username)->first();
        if($user && md5($this->password) == $user->password){
            session()->put('username', $this->username);
            session()->put('auth_token', md5($this->username));
            session()->flash('success', 'Logged in successfully');
            return $this->redirect('/', navigate:true);
        }
        session()->flash('error', 'Invalid Credentials');
        return $this->redirect('/login',navigate:true);
    }
    
    public function render()
    {
        return view('livewire.login');
    }
}
