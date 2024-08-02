<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Carbon\Carbon;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class AppJournal extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $table = 'journal';
    protected $primaryKey = '_id';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->journal_date_time)) {
                // Format the date as a string before saving
                $model->journal_date_time = Carbon::now()->format('Y-m-d H:i:s');
            }
        });
    }

    // Encrypt the content before saving it
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = encryptJournal($value, env('MY_ENCRYPT_KEY'));
    }

    // Decrypt the content when retrieving it
    public function getContentAttribute($value)
    {
        return decryptJournal($value, env('MY_ENCRYPT_KEY'));
    }
    public function getJournalDateTimeAttribute($value){
        return convertToPakistanTime($value);
    }
    public function setJournalDateTimeAttribute($value){
        $this->attributes['journal_date_time'] = convertFromPakistanTimeToUTC($value);
    }
}
