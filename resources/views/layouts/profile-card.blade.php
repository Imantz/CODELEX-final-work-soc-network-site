<div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset("img/prof.jpeg") }}" alt="Card image cap" height="auto" width="auto">
        <div class="card-body">
            <h5 class="card-title text-center">{{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }}</h5>
            <p class="card-text text-center">{{ Auth::user()->email }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center" style="border-bottom: none"><a class="card-link" href="">Gallery</a></li>
            <li class="list-group-item text-center" style="border-bottom: none"><a class="card-link" href="">Friends</a></li>
            <li class="list-group-item text-center"><a class="card-link" href="">Followers</a></li>
        </ul>
        {{--    <div class="card-body">--}}
        {{--        <a href="#" class="card-link">Card link</a>--}}
        {{--        <a href="#" class="card-link">Another link</a>--}}
        {{--    </div>--}}
    </div>
</div>
