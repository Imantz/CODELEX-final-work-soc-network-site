@extends("auth-user")
@section("wall")

    <h1>My friends!!</h1>
    <br>

    <br>
    <ul style="list-style-type: none;">
        @foreach($requests as $request)
            <li class="row">
                <p> friend request: {{ $request->name . " " . $request->surname }}
                    <a class="btn btn-outline-success" href="{{ route("friend.accept", ["username"=>$request->name]) }}">Accept</a>
                    <a class="btn btn-outline-danger" href="">Decline</a>
                </p>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <br>
        @foreach($friends as $user)
            <div class="col-md-2">
{{--                @if(Auth::user()->hasFriendRequestPending($user))--}}
{{--                    <p>Waiting {{ $user->name }} to accept your request</p>--}}
{{--                @elseif (Auth::user()->hasFriendRequestReceived($user))--}}
{{--                    <a href="{{ route("friend.accept", ["name" => $user->name ]) }}">Accept</a>--}}
{{--                @elseif(Auth::user()->isFriendsWith($user))--}}
{{--                    <p>You and {{ $user->name }} are friends</p>--}}
{{--                @elseif(Auth::user()->id !== $user->id)--}}
{{--                    <a href="{{ route("friend.add", ["username"=>$user->name]) }}">Add as friend</a>--}}
{{--                @endif--}}


                <a href="profile/{{ $user->id . "-" . $user->name . "-" . $user->surname }}" class="btn">
                    @if($user->img)
                        <img class="card-img-top" src="{{ asset("storage/" . $user->img) }}" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="Card image cap">
                    @endif
                    <h6 class="text-center">{{ $user->name }}</h6>
                    @if(Cache::has('user-is-online-' . $user->id))
                        <span class="text-success">Online</span>
                    @else
                        <span class="text-secondary">Offline</span>
                    @endif
                </a>
            </div>
        @endforeach
    </div>

    @endsection
