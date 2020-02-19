<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class WallFeed extends Model
{
    protected $fillable = [
        'text','user_id'
    ];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasLiked():bool
    {
        return (bool) Like::where("likeable_id", $this->id)
            ->where("user_id", Auth::user()->id)
            ->where("likeable_type","App\WallFeed")
            ->count();
    }

    public function likeCount(): int
    {
        return  Like::where("likeable_id", $this->id)->count();
    }
}
