@extends("auth-user")
@section("wall")

    <h1>My friends!!</h1>
    <br>

    <br>
    <ul style="list-style-type: none;">
        @foreach($requests as $request)
            <li class="row">
                <p> friend request: {{ "$request->name $request->surname" }}
                    <a class="btn btn-outline-success" href="{{ route("friend.accept", [$request->id,$request->name,$request->surname]) }}">Accept</a>
                    <a class="btn btn-outline-danger" href="{{ route("friend.remove", [$request->id,$request->name,$request->surname]) }}">Decline</a>
                </p>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <br>
        @foreach($friends as $user)
            <div class="col-md-2">

                <a href="{{ route("profile", [$user->id,$user->name,$user->surname]) }}" class="btn">
                    @if($user->img)
                        <img class="card-img-top" src="{{ asset("storage/" . $user->img) }}" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="Card image cap">
                    @endif
                    <h6 class="text-center">{{ $user->name }}</h6>
                    @if(Cache::has('user-is-online-' . $user->id))
                        <span class="text-success">Online</span>
                    @endif
                </a>
            </div>
        @endforeach
    </div>

    @endsection
