<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view("users/wall", compact("user"));
    }

    public function friends(User $user)
    {
        $friends = $user->friends()->except(Auth::user()->id);
        return view("users/friends", compact(["friends","user"]));
    }

    public function gallery(User $user)
    {
        $gallery = $user->galleries;

        return view("users/gallery", compact(["gallery","user"]));
    }

    public function album(User $user, Gallery $gallery)
    {
        $albums = $gallery->albums;
        return view("users/album", compact(["user","albums"]));
    }

    public function photo(User $user,Album $album)
    {
        return view("users/photo", compact(["user","album"]));
    }
}
