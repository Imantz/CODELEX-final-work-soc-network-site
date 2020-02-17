<h1 class="ml-3">Gallery</h1>

<div class="row flex-wrap ml-1">
    @foreach($gallery as $album)
        <div class="card col-3 m-2">
            <a href="{{ route("album.index", $album->id) }}">
                <img src="{{ asset("img/default_pokemon.png") }}" class="card-img-top pt-3">
                <div class="card-body">
                    <p class="card-text text-center"><small class="text-muted">{{ $album->title }}</small></p>
                </div>
            </a>
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
