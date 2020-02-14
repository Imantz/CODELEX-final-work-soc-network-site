<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Auth::user()->galleries;
        return view("authUser/gallery", compact("gallery"));
    }

    public function create(Request $request)
    {
        //TODO verificate this!
            Auth::user()->galleries()->create([
                "title"=> $request->title
            ]);

        return redirect()->route("gallery");
    }
}
