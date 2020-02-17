@extends("auth-user")
@section("wall")
    <div>
        <form action="/" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">Izveidot ierakstu</div>

                <div class="form-group">
                    <textarea style="border: none; resize: none;" class="form-control" id="exampleFormControlTextarea1" name="text" placeholder="Any text there.." rows="3"></textarea>
                </div>
                @error('text')
                <small class="text-danger ml-3">{{ $message }}</small>
                @enderror
                <button style="width: 80px;" class="btn btn-outline-success mb-2 ml-auto mr-2" type="submit" name="">Add</button>
            </div>
        </form>

        @foreach($wallFeeds as $feed)

            <div>
                <div class="card mt-2">

                    <div class="p-2">
                        <p>there must be post author name/link to profile</p>

                        <p class="p-1">{{ $feed->text }}</p>
                    </div>
                    <button style="width: 30px;" class="btn btn-outline-danger mb-2 ml-auto mr-2 p-1 rounded-circle" type="submit" name="">X</button>
                </div>
            </div>

            @endforeach

    </div>
@endsection
