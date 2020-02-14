<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        "user_id","follower_id"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
