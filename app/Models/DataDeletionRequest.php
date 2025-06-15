<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDeletionRequest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'reason',
        'token',
        'is_verified',
        'verified_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
