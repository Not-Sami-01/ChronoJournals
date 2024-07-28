<?php

namespace App\Livewire;

use Livewire\Component;

class Journal extends Component
{
        public $content;
        public $body;

    public function mount(){
        $this->content = '';
        $this->body = '';
    }
    public function test(){
        dd($this->all());
    }
    public function addEntry()
    {
        dd($this->all());
    }

    public function render()
    {
        $contentVal = $this->content;
        $data = compact('contentVal');
        return view('livewire.journal')->with('content', $this->content);
    }
}
