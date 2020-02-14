<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "gallery";

    protected $fillable = [
        "title"
    ];

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
