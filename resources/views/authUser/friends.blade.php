@extends("auth-user")
@section("wall")

    <h1>My friends!!</h1>
<div class="row">
    @foreach($requests as $request)
        <div class="col-md-2 text-center">

            <a href="{{ route("profile", $request->slug) }}" class="btn">
                @if($request->img)
                    <img class="card-img-top" src="{{ asset("storage/" . $request->img) }}" alt="Card image cap">
                @else
                    <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="Card image cap">
                @endif
                <h6 class="text-center">{{ $request->name }}</h6>
                @if(Cache::has('user-is-online-' . $request->id))
                    <span class="text-success">Online</span>
                @endif
            </a>
            <div>
                <form action="{{ route("friend.accept", $request) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-outline-success px-1 py-0" type="submit">{{ __('Accept') }}</button>
                </form>
                <form action="{{ route("friend.remove", $request) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger m-1 px-1 py-0" type="submit">{{ __('Decline') }}</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

    <div class="row">
        <br>
        @foreach($friends as $user)
            <div class="col-md-2">

                <a href="{{ route("profile", $user->slug) }}" class="btn">
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
