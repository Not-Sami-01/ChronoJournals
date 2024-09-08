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
        $username = trim(strtolower($this->username));
        $user = AppUsers::where('username', '=', $username)->first();
        if($user && md5($this->password) == $user->password){
            session()->put('username', $username);
            session()->put('user_id', $user->_id);
            session()->put('auth_token', md5($username));
            session()->flash('success', 'Logged in successfully');
            return $this->redirect('/', navigate:true);
        }
        session()->flash('error', 'Invalid Credentials');
        return $this->redirect('/login',navigate:true);
    }
    
    public function render()
    {
        if(checkLogin()){
            $this->redirect('/');
        }
        return view('livewire.login');
    }
}