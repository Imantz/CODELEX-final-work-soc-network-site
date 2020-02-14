<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        "img"
    ];

    public function Gallery()
    {
        $this->belongsTo(Gallery::class);
    }
}
