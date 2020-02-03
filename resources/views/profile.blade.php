@extends("layouts/app")
@section("content")

<div class="container">
    <div class="card" style="width: 18rem;">
        @if($user->img)
        <img class="card-img-top" src="{{ asset("storage/". $user->img) }}" alt="Card image cap" height="auto" width="auto">
        @else
            <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="Card image cap" height="auto" width="auto">
        @endif
        <div class="card-body">
            <h5 class="card-title text-center">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
            <p class="card-text text-center">{{ $user->email }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center">Wall</li>
            <li class="list-group-item text-center">Add friend</li>
            <li class="list-group-item text-center">Follow</li>
            <li class="list-group-item text-center">Gallery</li>
            <li class="list-group-item text-center">Friends</li>
        </ul>
        {{--    <div class="card-body">--}}
        {{--        <a href="#" class="card-link">Card link</a>--}}
        {{--        <a href="#" class="card-link">Another link</a>--}}
        {{--    </div>--}}
    </div>
</div>
@endsection
