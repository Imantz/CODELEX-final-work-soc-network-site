@extends("auth-user")
@section("wall")
    <div>

        <form action="/" method="POST">
            @csrf
            <div class="card" style="margin-bottom: 5px" >
                <div class="card-header">Izveidot ierakstu</div>


                    <textarea id="editor" style="border: none; resize: none;" class="form-control"  name="text" placeholder="Any text there.." rows="3"></textarea>

                @error('text')
                <small class="text-danger ml-3">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <button style="width: 80px; margin-right: 25px;" class=" btn btn-outline-success ml-auto" type="submit" name="">Add</button>
            </div>
        </form>

        @foreach($wallFeeds as $wallFeed)

            <div>
                <div class="card mt-2">

                    <div class="p-2">
                        @if($wallFeed->user_id !== Auth::user()->id)

                            <a href="
               {{ route("profile", $users->where("id",$wallFeed->user_id)->first())        }}">
                                {{ $users->where("id",$wallFeed->user_id)->first()->name  }}
                                {{ $users->where("id",$wallFeed->user_id)->first()->surname }}
                            </a>
                        @endif
                        <p class="p-1">{!! html_entity_decode($wallFeed->text) !!}</p>

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

                    @if($wallFeed->user_id === Auth::user()->id)
                        <form class="ml-auto" action="{{ route("post.delete", $wallFeed->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button style="width: 30px;" class="btn btn-outline-danger mb-2 mr-2 p-1 rounded-circle" type="submit" name="">X</button>
                        </form>

                    @endif
                </div>
            </div>

            @endforeach

    </div>




    <script>
        ClassicEditor
            .create(document.querySelector('#editor'),{
                removePlugins: [ 'Heading', 'Link' ],
                toolbar: [ 'bold', 'italic', ]
            });
        config.fillEmptyBlocks = false;
        config.fillEmptyBlocks = function (element) {
            if (element.attributes['class'].indexOf('clear-both') !== -1)
                return false;
        }
    </script>


    @endsection



