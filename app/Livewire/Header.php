<?php

namespace App\Livewire;

use App\Models\AppJournal;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Response;
use Dompdf\Dompdf;

class Header extends Component
{
    public $downloadModal = false;
    public $downloadMethod = 1;
    public function downloadDataModalToggle()
    {
        $this->downloadModal = !$this->downloadModal;
    }
    public function exportData()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->redirect('/login', navigate: true);
        }
        $journals = AppJournal::orderBy(column: 'journal_date_time', direction: 'asc')
            ->where('user_id', '=', $userId)->get();
        switch ((int) $this->downloadMethod) {
            case 1:
                $content = prettyPrintJson($journals);

                $tempFile = tempnam(sys_get_temp_dir(), 'download_');
                file_put_contents($tempFile, $content);
                $this->downloadModal = false;
                session()->flash('success', 'Download was successfull');
                return Response::download($tempFile, 'ChronoJournal_Journals.json')->deleteFileAfterSend(true);
            case 2:

                // Generate the content
                $contentStart = "
                    <!DOCTYPE html>
                        <html>
                        <head>
                        <style>
                        body{
                        font-family: Arial;
                        }
                        </style>
                        </head>
                        <body>";
                $contentEnd = "</body>
                        </html>
                    ";
                $journalsContent = '';
                foreach ($journals as $journal) {
                    $journalsContent .= "<h2>Date: $journal->journal_date_time</h2>".$journal->content . "<br><hr>";
                }
                $content = $contentStart . $journalsContent . $contentEnd;

                $tempFile = tempnam(sys_get_temp_dir(), 'download_');
                file_put_contents($tempFile, $content);
                $this->downloadModal = false;
                session()->flash('success', 'Download was successfull');
                return Response::download($tempFile, 'ChronoJournal_Journals.html')->deleteFileAfterSend(true);
            // return dd($journalsContent);

            default:
                $this->downloadModal = false;
                break;
        }
    }
    public function refreshComponent($url)
    {
        $this->redirect($url, navigate: true);
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
        $this->redirect(url("journal/$journal->_id"), navigate: true);
    }
    public function logout()
    {
        session()->flush();
        return $this->redirect('/login', navigate: true);
    }


    public function render()
    {
        return view('components.header')->with('downloadModal', $this->downloadModal);
    }


}
