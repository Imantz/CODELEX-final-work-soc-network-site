@extends("users")

    @section("wall")

        <h1 class="ml-3">Album</h1>
        @if(isset($albums))
            <div class="row flex-wrap ml-3">
                @foreach($albums as $photo)
                    <div class="card col-3">
                        <a href="{{ route("user.photo", [$user,$photo->id]) }}">
                            <img src="{{ asset("storage/". $photo->img) }}" class="card-img-top pt-3">
                            <div class="card-body">
                                <p class="card-text text-center"><small class="text-muted">Like? Comment?</small></p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        @endsection
