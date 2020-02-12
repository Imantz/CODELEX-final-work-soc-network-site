@if(Route::currentRouteName() === "following")
<h1>following to</h1>
    @else
    <h1>following to me</h1>
@endif
<div class="row">
    @foreach($followers as $user)
        <div class="col-md-2">
            <a href="{{ route("profile", [$user->id,$user->name,$user->surname]) }}" class="btn">
                @if($user->img)
                    <img class="card-img-top" src="{{ asset("storage/$user->img") }}" alt="Card image cap">
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
