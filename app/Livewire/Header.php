<?php

namespace App\Livewire;

use App\Models\AppJournal;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Header extends Component
{
    
    public function refreshComponent($url){
        $this->redirect($url, navigate:true);
    }
    public function addJournal()
    {
        if (!checkLogin()) {
            session()->flush();
            session()->flash('error', 'Some error occured please login again');
            return $this->redirect('/login', navigate: true);
        }
        $userId = session()->get('user_id');
        // Perform database operations to save the entry
        $journal = new AppJournal();
        $journal->content = '';
        $journal->tag = null;
        $journal->user_id = $userId;
        $journal->save();
        session()->flash('success', 'Entries saved successfully');
        $this->redirect(url("journal/$journal->_id"), navigate:true);
    }
    public function logout(){
        session()->flush();
        return $this->redirect('/login', navigate:true);
    }
    

public function render()
{
    return view('components.header');
}

    
}
