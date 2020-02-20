@extends("users")
@section("wall")

    @foreach($user->wallFeeds as $wallFeed)

        <div>
            <div class="card mt-2">

                <div class="p-2">

                    <p class="p-1">{{ $wallFeed->text }}</p>
                    @if( ! $wallFeed->hasLiked())
                        <form action="{{ route("like.post", $wallFeed) }}" method="POST">
                            @csrf
                            <button class="btn text-info" type="submit">{{ __("Like") }}</button>
                            <small class="p-1 ml-3">{{  $wallFeed->likeCount() }} {{ __("liked") }}</small>
                        </form>
                        @else
                        <form action="{{ route("unlike.post", $wallFeed) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn text-info" type="submit">{{ __("Unlike") }}</button>
                            <small class="p-1">{{  $wallFeed->likeCount() }} {{ __("liked") }}</small>
                        </form>
                        @endif


                </div>
            </div>
        </div>

    @endforeach

@endsection
