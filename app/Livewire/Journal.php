<?php

namespace App\Livewire;

use App\Models\AppJournal;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

class Journal extends Component
{
    public $content;
    public $datetime;
    public $tag = null;
    public function editEntry($id){
        if (!checkLogin()) {
            session()->flush();
            session()->flash('error', 'Some error occured please login again');
            return $this->redirect('/login', navigate: true);
        }
        $journal = AppJournal::where('_id', '=', $id)->get()->first();
        // return dd($journal);
        $datetime = $this->datetime;
        if(!$journal){session()->flush(); return $this->redirect('/login', navigate:true);}
        $this->content? $journal->content = $this->content : null;
        $this->tag? $journal->tag = $this->tag: $journal->tag = '';
        $datetime? $journal->journal_date_time = myFormatDateTime($this->datetime): null;
        $journal->save();

    }

    public $journalId;

    public function mount($id = null)
    {
        $this->journalId = $id;
    }

    public function render()
    {
        // $this->journalId = 2;
        if($this->journalId){
            $journal = AppJournal::where('_id', '=', $this->journalId)->get()->first();
            $date = valueFormattedDate($journal->journal_date_time);
            $this->datetime = $date;
            $this->tag = $journal->tag;
            $data = compact('journal');
            return view('livewire.journal', $data);
        }
        return view('livewire.journal');
    }
}
