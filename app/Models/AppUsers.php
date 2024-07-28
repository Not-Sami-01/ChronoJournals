<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUsers extends Model
{
    use HasFactory;

    protected $table = 'app_users';
    protected $primary_key = 'user_id';

}
