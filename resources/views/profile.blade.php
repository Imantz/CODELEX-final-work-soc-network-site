@extends("layouts/app")
@section("content")


    <div class="container">
        <div class="row">

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
                    <li class="list-group-item text-center" style="border-bottom: none">Wall</li>

                    <li class="list-group-item text-center" style="border-bottom: none">

                    @if(Auth::user()->hasFriendRequestPending($user))
                        <p>Waiting to accept your request</p>
                    @elseif (Auth::user()->hasFriendRequestReceived($user))

                        <a href="{{ route("friend.accept", ["username" => $user->name ]) }}">Accept</a>
                        <a href="">Decline</a>
                    @elseif(Auth::user()->isFriendsWith($user))
                            <a href="{{ route("friend.remove", ["username"=>$user->name]) }}">Remove</a>
                    @elseif(Auth::user()->id !== $user->id)
                        <a class="btn" href="{{ route("friend.add", ["username"=>$user->name]) }}">Send friend request</a>
                    @endif

                    </li>

                    <li class="list-group-item text-center" style="border-bottom: none">Gallery</li>
                    <li class="list-group-item text-center">Friends</li>
                </ul>
            </div>

            <div class="justify-content-end col-md-8">
                @yield("wall")
            </div>
        </div>


    </div>

@endsection
