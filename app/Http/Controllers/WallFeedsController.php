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

    public function create(Request $request, WallFeed $wallFeed)
    {
        $validatedData = $request->validate([
            'text' => ['required'],
        ]);

        $wallFeed = new WallFeed();
        $wallFeed->name = Auth::user()->name;
        $wallFeed->user_id = Auth::user()->id;
        $wallFeed->text = $validatedData["text"];
        $wallFeed->save();

        return redirect("/");
    }
}
