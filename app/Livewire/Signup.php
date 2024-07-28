<?php

namespace App\Livewire;

use App\Models\AppUsers;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;


class Signup extends Component
{
    public $username;
    public $password;
    public $password_confirmation;

    public function save(){
        $this->validate([
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);
        if($this->password !== $this->password_confirmation){
            session()->flash('error', 'Passwords do not match');
            return $this->redirect('/signup',navigate:true);
        }
        // Perform database operations to save the user
        $checkuser = AppUsers::where('username', '=', $this->username)->first();
        if($checkuser){
            session()->flash('error', 'Username already exists, please choose a different one');
            return $this->redirect('/signup',navigate:true);
        }
        $password = md5($this->password);
        $user = new AppUsers();
        $user->username = $this->username;
        $user->password = $password;
        $user->save();
        if($user){
            session()->flash('success', 'Account created successfully, please log to our website');
            return $this->redirect('/login', navigate: true);
        }else{
            session()->flash('error', 'Some error occurred, please try again');
            return $this->redirectIntended('/default/url', navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.signup');
        // echo 'Helo WOrld';
    }

}
