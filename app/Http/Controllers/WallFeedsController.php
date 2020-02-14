<?php

namespace App\Http\Controllers;

use App\WallFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallFeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'text' => ['required'],
        ]);

        Auth::user()->WallFeeds()->create([
            "name" => Auth::user()->name,
            "text" => $validatedData["text"]
        ]);

        return redirect("/");
    }
}
