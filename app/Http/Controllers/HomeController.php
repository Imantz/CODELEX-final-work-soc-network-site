<?php

namespace App\Http\Controllers;

use App\User;

use App\WallFeed;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wallFeeds = WallFeed::all();

        return view('layouts/wall-feed', compact("wallFeeds"));
    }
    public function show()
    {
        return view("my-profile");
    }
}
