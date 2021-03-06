@extends("auth-user")

@section("wall")

    <h1 class="ml-3">Gallery</h1>

    <div class="row flex-wrap ml-1">
        @foreach($gallery as $album)
            <div class="card col-3 m-2">
                <a href="{{ route("album.index", $album->id) }}">
                    @if($album->isEmpty())
                    <img src="{{ asset("img/default_pokemon.png") }}" class="card-img-top pt-3">
                        @else
                        <img src="{{ asset("storage/" . $album->getIcon() ) }}" class="card-img-top pt-3"
                        style="height: 150px">

                    @endif
                    <div class="card-body">
                        <p class="card-text text-center"><small class="text-muted">{{ $album->title }}</small></p>
                    </div>
                </a>
                <form action="/gallery/{{ $album->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn text-danger" type="submit">{{ __('Delete') }}</button>
                </form>
            </div>
        @endforeach
    </div>


    <form class="mt-3 ml-3" action="{{ route("gallery.create") }}" method="POST">
        @csrf
        <input type="text" name="title">
        <button type="submit">Create gallery</button>
        @error('title')
        <small class="text-danger row ml-1">{{ $message }}</small>
        @enderror
    </form>

@endsection
