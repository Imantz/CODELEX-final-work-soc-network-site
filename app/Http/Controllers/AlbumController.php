<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
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

}
