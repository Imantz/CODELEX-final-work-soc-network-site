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

    public function isEmpty():bool
    {
        return ! $this->albums()->count() > 0;
    }

    public function getIcon():string
    {
        return $this->albums()->inRandomOrder()->first()->img;
    }
}
