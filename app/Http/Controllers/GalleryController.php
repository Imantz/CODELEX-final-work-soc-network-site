<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view("authUser/gallery");
    }

    public function create(Request $request)
    {

     //       $user = Auth::user();
    //        $user->update($this->validateRequest());
    //        $this->storeImage($user);

        dd($request);
        return view("authUser/gallery");
    }

    private function storeImage(User $user)
    {
        if(request()->hasFile("img")){
            $user->update([
                "img" => request()->img->store("gallery","public"),
            ]);
        }
    }

    public function validateRequest()
    {
        if(request()->hasFile("img"))
        {
            return request()->validate([
                "img"=>["file","image","max:5000"]
            ]);
        }
    }
}
