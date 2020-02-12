<div>
    <div class="card" style="width: 18rem;">
        @if(Auth::user()->img)
        <img class="card-img-top" src="{{ asset("storage/" . Auth::user()->img ) }}" alt="there must be profile img" height="auto" width="auto">
            @else
            <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="there must be profile img" height="auto" width="auto">
        @endif
        <div class="card-body">
            <h5 class="card-title text-center">{{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }}</h5>
            <p class="card-text text-center">{{ Auth::user()->email }}</p>
            <p class="card-text text-center">id: {{ Auth::user()->id }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("friends") }}">Friends</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("gallery") }}">Gallery</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("following") }}">I'm following</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("followers") }}">My followers</a>
            </li>
        </ul>
    </div>
</div>
