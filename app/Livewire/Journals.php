<?php

namespace App\Livewire;

use App\Models\AppJournal;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Journals extends Component
{
    use WithPagination;
    public $asc = false;
    public $search = '';
    public $all = false;
    public $pagination = 10;
    public function setPagination($pagination){
        $this->pagination = $pagination;
    }
    public function toggleAsc()
    {
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
        if ($this->Recyclebin === true) {
            if($this->all === true){
                $journals = AppJournal::orderBy('journal_date_time', $this->asc ? 'asc' : 'desc')
                    ->onlyTrashed()  // Include only soft-deleted (trashed) records
                    ->where('user_id', '=', $userId)->get();
            }else{
                $journals = AppJournal::orderBy('journal_date_time', $this->asc ? 'asc' : 'desc')
                    ->onlyTrashed()  // Include only soft-deleted (trashed) records
                    ->where('user_id', '=', $userId)
                    ->paginate($this->pagination); 
            }
        }
        else {
            if($this->all === true){
                $journals = AppJournal::orderBy('journal_date_time', $this->asc ? 'asc' : 'desc')
                    ->where('user_id', '=', $userId)->get();
            }else{
                $journals = AppJournal::orderBy('journal_date_time', $this->asc ? 'asc' : 'desc')
                    ->where('user_id', '=', $userId)
                    ->paginate($this->pagination);
            }
        }
        if ($this->search !== '') {
            $journals = $journals->filter(function ($journal) {
                // Convert to strings if they are arrays
                $content = is_array($journal->content) ? implode(' ', $journal->content) : $journal->content;
                $tag = is_array($journal->tag) ? implode(' ', $journal->tag) : $journal->tag;
                $journal_date_time = is_array($journal->journal_date_time) ? implode(' ', $journal->journal_date_time) : $journal->journal_date_time;

                // Ensure that the search term is treated as a string
                $search = (string) $this->search;

                return stripos($content, $search) !== false ||
                    stripos($tag, $search) !== false ||
                    stripos($journal_date_time, $search) !== false;
            });
        }
        if (!$journals) {
            return view('livewire.journals');
        }
        $asc = $this->asc;
        $search = $this->search;
        $pagination = $this->pagination;
        $all = $this->all;
        $data = compact('journals', 'asc', 'search', 'pagination', 'all');
        return view('livewire.journals')->with($data);

    }
    public function editJournal($id)
    {
        $data = compact('id');
        return $this->redirect("/journal/$id", navigate: true);
    }
    public function deleteEntry($id)
    {
        $journal = AppJournal::find($id);
        if (!$journal) {
            session()->flash('error', 'Journal not found');
            return $this->redirect('/', navigate: true);
        }
        $journal->delete();
        session()->flash('success', 'Journal moved to recycle bin');
        return $this->redirect('/', navigate: true);
    }
    public function restoreDelete($id)
    {
        $journal = AppJournal::onlyTrashed()->where('_id', '=', $id)->first();
        if (!$journal) {
            session()->flash('error', 'Journal not found');
            return $this->redirect('/recyclebin', navigate: true);
        }
        $journal->restore();
        session()->flash('success', 'Journal restored successfully');
        return $this->redirect('/recyclebin', navigate: true);
    }
    public function forceDelete($id)
    {
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
