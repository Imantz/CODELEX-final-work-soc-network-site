<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return tap([
            'name' => ['required', 'max:10'],
            'surname' => ['required'],
            'phone' => ['nullable','numeric'],
            'email' => ['nullable'],
            'dob' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zip' => ['nullable'],
            'bio' => ['nullable'],
        ], function(){
            if(request()->password)
            {
                dd(request()->password);
            }
            if(request()->hasFile("img"))
            {
                request()->validate([
                    "img"=>["file","image","max:5000"]
                ]);
            }
        });
    }
}
