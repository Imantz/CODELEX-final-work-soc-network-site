@extends("users")
@section("wall")

    @foreach($user->wallFeeds as $feed)

        <div>
            <div class="card mt-2">

                <div class="p-2">
                    <p>{{ $feed->name }}</p>

                    <p class="p-1">{{ $feed->text }}</p>
                </div>
            </div>
        </div>

    @endforeach

@endsection
