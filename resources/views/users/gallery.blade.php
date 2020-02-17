@extends("users")
@section("wall")


    <h1 class="ml-3">Gallery</h1>

    <div class="row flex-wrap ml-1">
        @foreach($gallery as $album)
            <div class="card col-3 m-2">
                <a href="{{ route("user.album", [$user, $album]) }}">
                    <img src="{{ asset("img/default_pokemon.png") }}" class="card-img-top pt-3">
                    <div class="card-body">
                        <p class="card-text text-center"><small class="text-muted">{{ $album->title }}</small></p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


@endsection
