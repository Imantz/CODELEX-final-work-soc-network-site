<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Album extends Model
{
    protected $fillable = [
        "img"
    ];

    public function Gallery()
    {
        $this->belongsTo(Gallery::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function hasLiked():bool
    {
        return (bool) Like::where("likeable_id", $this->id)
            ->where("user_id", Auth::user()->id)
            ->where("likeable_type","App\Album")
            ->count();
    }

    public function likeCount(): int
    {
        return  Like::where("likeable_id", $this->id)->count();
    }
}
