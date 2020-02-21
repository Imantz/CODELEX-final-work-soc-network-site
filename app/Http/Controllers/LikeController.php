<?php

namespace App\Http\Controllers;

use App\Album;
use App\User;
use App\WallFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    // like user photo
    public function likePost(WallFeed $wallFeed)
    {
       $wallFeed->likes()->updateOrCreate(["user_id"=>Auth::user()->id]);

        return redirect()->back();
    }
    public function unlikePost(WallFeed $wallFeed)
    {
        $wallFeed->likes()->where("user_id",Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function likePhoto(Album $album)
    {
        $album->likes()->updateOrCreate(["user_id"=>Auth::user()->id]);

        return redirect()->back();
    }
    public function unlikePhoto(Album $album)
    {
        $album->likes()->where("user_id",Auth::user()->id)->delete();
        return redirect()->back();
    }

}
