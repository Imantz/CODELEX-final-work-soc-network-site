<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGallery;
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
}
