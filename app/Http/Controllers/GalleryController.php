<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Http\Requests\StoreGallery;
use App\User;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Auth::user()->galleries;
        return view("authUser/gallery", compact("gallery"));
    }

    public function store(StoreGallery $request)
    {
            Auth::user()->galleries()->create($request->validated());

        return redirect()->route("gallery");
    }

    public function gallery(User $user)
    {
        $gallery = $user->galleries;

        return view("users/gallery", compact(["gallery","user"]));
    }

    public function delete($id)
    {

        Album::where("gallery_id",$id)->delete();
        Gallery::where("id", $id)->delete();
        return redirect()->route("gallery");
    }
}
