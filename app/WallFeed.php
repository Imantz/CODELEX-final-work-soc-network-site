<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WallFeed extends Model
{
    protected $fillable = [
        'text','user_id'
    ];
}
