<?php

namespace Database\Seeders;

use App\Models\AppJournal;
use App\Models\AppUsers;
use DateTime;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedJournals extends Seeder
{
    /**
     * Run the database seeds.
     */

    function convertDateFormat($isoDate)
    {
        try {
            $date = new DateTime($isoDate);
            return $date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return 'Invalid date';
        }
    }
    public function run(): void
    {
        $fileData = readAndProcessJsonFile('C:\Users\hp\Downloads\monkkee-20240801180606.json', true);
        $entries = $fileData['entries'];
        foreach ($entries as $entry) {
            $journal = new AppJournal();
            $journal->content = $entry['content'];
            $journal->tag = $entry['tag_assignments'];
            $journal->user_id = '66abad530369e49338062f42';
            $journal->journal_date_time = $this->convertDateFormat($entry['date']);
            $journal->save();
        }
    }
}
