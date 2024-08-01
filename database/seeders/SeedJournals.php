<?php

namespace Database\Seeders;

use App\Models\AppJournal;
use App\Models\AppUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedJournals extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $journal = new AppJournal();
        $journal->content = 'NothingSpecial';
        $journal->tag = 'This is a seeder';
        $journal->user_id = '66a8dab7cf52ba24af050e22';
        $journal->save();
    }
}
