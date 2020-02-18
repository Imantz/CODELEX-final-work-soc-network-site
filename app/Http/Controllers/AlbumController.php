<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index(Gallery $gallery)
    {
        $albums = $gallery->albums;
        return view("authUser/album", compact("gallery","albums"));
    }

    public function create(Request $request, Gallery $gallery)
    {

        if($request->hasFile("img")){
            $gallery->albums()->create([
                "img" => $request->img->store("uploads","public"),
            ]);
        }

        return redirect()->back();
    }

    public function show(Album $album)
    {
        return view("authUser/photo", compact("album"));
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

    public function delete(Album $album)
    {
        $album->delete();
        return redirect("/gallery/album/" . $album->gallery_id );
    }
}
