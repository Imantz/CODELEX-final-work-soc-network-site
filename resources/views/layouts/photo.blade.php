<div class="ml-3">
        <div class="card">
            <img class="card-img-top p-3" src="{{ asset("storage/". $album->img) }}" height="500px">
                <div class="card-body">

                    @if( ! $album->hasLiked())
                        <form action="{{ route("like.photo", $album) }}" method="POST">
                            @csrf
                            <button class="btn text-info" type="submit">{{ __("Like") }}</button>
                            <small class="p-1 ml-3">{{  $album->likeCount() }} {{ __("liked") }}</small>
                        </form>
                    @else
                        <form action="{{ route("unlike.photo", $album) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn text-info" type="submit">{{ __("Unlike") }}</button>
                            <small class="p-1">{{  $album->likeCount() }} {{ __("liked") }}</small>
                        </form>
                    @endif
                </div>
        </div>
</div>
