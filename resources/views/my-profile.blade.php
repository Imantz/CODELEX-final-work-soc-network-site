@extends('home')

@section('wall')
        <?php

            //TODO passwords change and email

        ?>


    <form class="ml-5" action="my-profile" method="POST" enctype="multipart/form-data">
        <h4>Edit your profile info</h4>
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="name">First name</label>
                <input type="text" class="form-control" id="name" value="{{ ucfirst(Auth::user()->name) }}" name="name">
            </div>
            <div class="col-md-4 mb-3">
                <label for="surname">Last name</label>
                <input type="text" class="form-control" id="surname" value="{{ ucfirst(Auth::user()->surname) }}" name="surname">
            </div>
        </div>

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
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Phone number</label>
                <input type="text" class="form-control mt-2" id="validationDefault01" placeholder="" value="{{ Auth::user()->phone }}" name="phone">
            </div>
        </div>

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

        <div class="form-row">
            <div class="col-md-8 mb-3">
                <label for="about">About me:</label>
                <textarea style="resize: none;" class="form-control" id="about" placeholder="Any text there.." rows="4" name="bio"></textarea>
            </div>
        </div>
        <button class="btn btn-outline-dark " type="submit" name="submit">Save</button>
    </form>

@endsection


