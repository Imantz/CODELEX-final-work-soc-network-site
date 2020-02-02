@extends("home")
@section("wall")

    <h1>All registered users</h1>
    <div class="row">
        @foreach($users as $user)
        <div class="col-md-2">
            <a href="profile/{{ $user->id . "-" . $user->name . "-" . $user->surname }}" class="btn">
                <img class="card-img-top" src="{{ asset("img/prof.jpeg") }}" alt="Card image cap">
                <h6 class="text-center">{{ $user->name }}</h6>
            </a>
        </div>
        @endforeach
    </div>
    @endsection
