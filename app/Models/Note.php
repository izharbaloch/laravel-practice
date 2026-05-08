<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'user_id', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
