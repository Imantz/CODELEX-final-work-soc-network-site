@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                    @include("layouts/profile-card")
            <div class="justify-content-end col-md-8">
                    @yield("wall")
            </div>
        </div>


    </div>

@endsection
