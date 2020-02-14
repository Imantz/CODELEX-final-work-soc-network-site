<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WallFeed extends Model
{
    protected $fillable = [
        'text','user_id','name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
