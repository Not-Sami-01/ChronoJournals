<?php

namespace App\Livewire;

use App\Models\AppJournal;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Journals extends Component
{
    public $asc = false;
    public $search = '';
    public function toggleAsc(){
        $this->asc = !$this->asc;
    }
    public $Recyclebin;
    public function render()
    {
        if (!checkLogin()) {
            session()->flush();
            session()->flash('error', 'Session Expired');
            return $this->redirect('/login', navigate: true);
        }
        $userId = session()->get('user_id');
        if($this->Recyclebin === true){
            $journals = AppJournal::orderBy('journal_date_time', $this->asc === true? 'asc': 'desc' )->onlyTrashed()->where('user_id', '=', $userId)->get();
        }else{
            $journals = AppJournal::orderBy('journal_date_time', $this->asc === true? 'asc': 'desc' )->where('user_id', '=', $userId)->get();
        }
        if($this->search !== ''){
            $journals = $journals->filter(function ($journal) {
                return stripos($journal->content, $this->search) !== false || stripos($journal->tag, $this->search) !== false || stripos($journal->journal_date_time, $this->search) !== false;
            });
        }
        if (!$journals) {
            return view('livewire.journals');
        }
        $asc = $this->asc;
        $data = compact('journals','asc');
        return view('livewire.journals')->with($data);

    }
    public function editJournal($id){
        $data = compact('id');
        return $this->redirect("/journal/$id", navigate:true);
    }
    public function deleteEntry($id){
        $journal = AppJournal::find($id);
        if (!$journal) {
            session()->flash('error', 'Journal not found');
            return $this->redirect('/', navigate: true);
        }
        $journal->delete();
        session()->flash('success', 'Journal moved to recycle bin');
        return $this->redirect('/', navigate: true);
    }
    public function restoreDelete($id){
        $journal = AppJournal::onlyTrashed()->where('_id', '=', $id)->first();
        if (!$journal) {
            session()->flash('error', 'Journal not found');
            return $this->redirect('/recyclebin', navigate: true);
        }
        $journal->restore();
        session()->flash('success', 'Journal restored successfully');
        return $this->redirect('/recyclebin', navigate: true);
    }
    public function forceDelete($id){
        $journal = AppJournal::onlyTrashed()->where('_id', '=', $id)->first();
        if (!$journal) {
            session()->flash('error', 'Journal not found');
            return $this->redirect('/recyclebin', navigate: true);
        }
        $journal->forceDelete();
        session()->flash('success', 'Journal deleted successfully');
        return $this->redirect('/recyclebin', navigate: true);
    }
}
