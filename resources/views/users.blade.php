@extends("layouts.app")
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
                    @if(Route::currentRouteName() !== "profile")
                    <li class="list-group-item text-center" style="border-bottom: none">Wall</li>
                    @endif
                    <li class="list-group-item text-center" style="border-bottom: none">

                    @if(Auth::user()->hasFriendRequestPending($user))
                        <p>Waiting to accept your request</p>
                            <a href="">
                                <a href="{{ route("friend.remove", [$user->id,$user->name,$user->surname]) }}">Cancel request</a>
                            </a>
                    @elseif (Auth::user()->hasFriendRequestReceived($user))

                        <a href="{{ route("friend.accept", ["username" => $user->name ]) }}">Accept</a>
                        <a href="">Decline</a>
                    @elseif(Auth::user()->isFriendsWith($user))
                            <a href="{{ route("friend.remove", [$user->id,$user->name,$user->surname]) }}">Remove</a>
                    @elseif(Auth::user()->id !== $user->id)
                        <a class="btn" href="{{ route("friend.add", [$user->id,$user->name,$user->surname]) }}">Send friend request</a>
                    @endif

                    </li>
                </ul>
            </div>

            <div class="justify-content-end col-md-8">
                @yield("wall")
            </div>
        </div>


    </div>

@endsection
