<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class AppUsers extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'app_users';
    protected $primary_key = '_id';
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = trim(strtolower($value));
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }
}
