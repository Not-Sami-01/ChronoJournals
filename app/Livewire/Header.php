<?php

namespace App\Livewire;

use Illuminate\Auth\Events\Logout;
use Livewire\Component;

class Header extends Component
{
    public function logout(){
        session()->flush();
        return $this->redirect('/login', navigate:true);
    }
    public function render()
    {
        return view('components.header');
    }
}
