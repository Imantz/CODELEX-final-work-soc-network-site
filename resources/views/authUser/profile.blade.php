@extends('auth-user')

@section('wall')


    <form class="ml-5" action="{{ route("profile.update") }}" method="POST" enctype="multipart/form-data">
        <h4>Edit your profile info</h4>
        @method('PUT')
        @csrf
            {{--   Name & Surname   --}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="name">First name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" value="{{ ucfirst(Auth::user()->name) }}" name="name">
            </div>
            <div class="col-md-4 mb-3">
                <label for="surname">Last name</label>
                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                       id="surname" value="{{ ucfirst(Auth::user()->surname) }}" name="surname">
            </div>
        </div>
            {{--   Email & Mobile    --}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ ucfirst(Auth::user()->email) }}" name="email">
            </div>
            <div class="col-md-4 mb-3">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" value="{{ Auth::user()->phone }}" name="phone">
            </div>
        </div>
            {{--   Password & Password_confirmation    --}}

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-4">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

            {{--   Img & Phone    --}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <p>Change profile picture</p>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="img">
                        <label class="custom-file-label" for="image">Choose image</label>
                    </div>
                </div>
            </div>
        </div>
            {{--   Dob & City    --}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="date">Birth date:</label>
                <input type="date" class="form-control" id="date" value="{{ Auth::user()->dob }}" name="dob">
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault03">City</label>
                <input type="text" class="form-control" id="validationDefault03" value="{{ Auth::user()->city }}" name="city">
            </div>
        </div>
            {{--   State & Zip    --}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationDefault04">State</label>
                <input type="text" class="form-control" id="validationDefault04" value="{{ Auth::user()->state }}" name="state">
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault05">Zip</label>
                <input type="text" class="form-control" id="validationDefault05" value="{{ Auth::user()->zip }}" name="zip">
            </div>
        </div>
            {{--   Bio & Submit    --}}
        <div class="form-row">
            <div class="col-md-8 mb-3">
                <label for="about">About me:</label>
                <textarea style="resize: none; padding: 5px" class="form-control" id="about" rows="4" name="bio">
                    {{ Auth::user()->bio }}
                </textarea>
            </div>
        </div>
        <button class="btn btn-outline-dark " type="submit" name="submit">Save</button>
    </form>

@endsection


