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
                            <small>Waiting to accept your request</small>
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">{{ __('Cancel request') }}</button>
                            </form>
                        @elseif (Auth::user()->hasFriendRequestReceived($user))

                            <form action="{{ route("friend.accept", $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn text-success" type="submit">{{ __('Accept') }}</button>
                            </form>
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-danger" type="submit">{{ __('Decline') }}</button>
                            </form>
                        @elseif(Auth::user()->isFriendsWith($user))
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">{{ __('Remove friend') }}</button>
                            </form>
                        @elseif(Auth::user()->id !== $user->id)
                            <form action="{{ route("friend.add", $user) }}" method="POST">
                                @csrf
                                <button class="btn">{{ __('Send friend request') }}</button>
                            </form>
                        @endif

                    </li>
                    @if(Auth::user()->isFollowing($user))
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <form action="{{ route("unfollow", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">Unfollow</button>
                            </form>
                        </li>
                    @else
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <form action="{{ route("follow", $user) }}" method="POST">
                                @csrf
                                <button class="btn" type="submit">Follow</button>
                            </form>
                        </li>
                    @endif
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <a href="{{ route("user.friends", $user) }}">{{ __("Friends") }}</a>
                        </li>
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <a href="{{ route("user.gallery", $user) }}">{{ __("Gallery") }}</a>
                        </li>
                </ul>
            </div>

            <div class="justify-content-end col-md-8">
                @yield("wall")
            </div>
        </div>


    </div>

@endsection
