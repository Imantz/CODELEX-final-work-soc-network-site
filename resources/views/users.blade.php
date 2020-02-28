@extends("layouts.app")
@section("content")


    <div class="container">
        <div class="row">

            <div class="card" style="width: 18rem;">
                @if($user->img)
                    <img class="card-img-top" src="{{ asset("storage/". $user->img) }}" alt="Card image cap" height="auto" width="auto">
                @else
                    <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="Card image cap" height="auto" width="auto">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
                    <p class="card-text text-center">{{ $user->email }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center position-relative" id="message_parent_node" style="border-bottom: none">
                        <button type="button" onclick="show_message_card()" class="btn text-danger">Send Message</button>
                    </li>
                    @if(Route::currentRouteName() !== "profile")
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <a href="{{ route("profile", $user) }}">Posts</a>
                        </li>
                    @endif
                    <li class="list-group-item text-center" style="border-bottom: none">

                        @if(Auth::user()->hasFriendRequestPending($user))
                            <small class="text-black-50">Waiting to accept your request</small>
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-success" type="submit">{{ __('Cancel request') }}</button>
                            </form>
                        @elseif (Auth::user()->hasFriendRequestReceived($user))

                            <form action="{{ route("friend.accept", $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn text-success" type="submit">{{ __('Accept') }}</button>
                            </form>
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-danger" type="submit">{{ __('Decline') }}</button>
                            </form>
                        @elseif(Auth::user()->isFriendsWith($user))
                            <form action="{{ route("friend.remove", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">{{ __('Remove friend') }}</button>
                            </form>
                        @elseif(Auth::user()->id !== $user->id)
                            <form action="{{ route("friend.add", $user) }}" method="POST">
                                @csrf
                                <button class="btn text-primary">{{ __('Send friend request') }}</button>
                            </form>
                        @endif

                    </li>
                    @if(Auth::user()->isFollowing($user))
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <form action="{{ route("unfollow", $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-success" type="submit">Unfollow</button>
                            </form>
                        </li>
                    @else
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <form action="{{ route("follow", $user) }}" method="POST">
                                @csrf
                                <button class="btn text-primary" type="submit">Follow</button>
                            </form>
                        </li>
                    @endif
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <a href="{{ route("user.friends", $user) }}">{{ __("Friends") }}</a>
                        </li>
                        <li class="list-group-item text-center" style="border-bottom: none">
                            <a href="{{ route("user.gallery", $user) }}">{{ __("Gallery") }}</a>
                        </li>
                </ul>
            </div>

            <div class="justify-content-end col-md-8">
                @if (session('msg_flash'))
                    <div class="alert alert-success">
                        {{ session('msg_flash') }}
                    </div>
                @endif
                @yield("wall")
            </div>
        </div>

        <script>
            const message_parent_node = document.getElementById("message_parent_node");

            function show_message_card()
            {
                const message_card_html = `
                <div class="position-absolute" style="
                            height: 260px;
                            z-index: 1;
                            width: 700px;
                            top: -200px;
                            left: 77%;
                            background-color: #6c757d;
                            ">
                    <form
                     action="{{ route("message.new", $user->id) }}"
                     method="POST"
                     style="width: 650px; margin: auto;">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="text-white">Message title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="body" class="text-white">Message</label>
                            <textarea style="resize: none;"
                                      class="form-control"
                                      id="title"
                                      name="body"
                                      rows="3"> </textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-danger">Send</button>
                        <button onclick="close_message()" class="btn btn-success">Close</button>
                    </form>
                </div>`;

                message_parent_node.insertAdjacentHTML('beforeend', message_card_html);
            }

            function close_message()
            {
                message_parent_node.removeChild(message_parent_node.lastChild);
            }

        </script>


    </div>

@endsection
