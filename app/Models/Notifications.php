<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //
    protected $table = 'notification';
    protected $fillable = [
        'user_id',
        'title',
        'message'
    ];
}
