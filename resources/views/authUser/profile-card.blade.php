<div>
    <div class="card" style="width: 18rem;">
        @if(Auth::user()->img)
            <div class="position-relative" id="image_node_parrent"
                 onmouseover="image_option()"
                 onmouseout="image_without_option()"
            >
                <img class="card-img-top"
                     src="{{ asset("storage/" . Auth::user()->img ) }}"
                     alt="there must be profile img"
                     height="auto"
                     width="auto"
                >
            </div>
            @else
            <img class="card-img-top" src="{{ asset("img/default_pokemon.png") }}" alt="there must be profile img" height="auto" width="auto">
        @endif
        <div class="card-body">
            <h5 class="card-title text-center">{{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }}</h5>
            <p class="card-text text-center">{{ Auth::user()->email }}</p>
            <p class="card-text text-center">id: {{ Auth::user()->id }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("messages") }}">Messages</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("friends") }}">Friends</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("gallery") }}">Gallery</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("following") }}">I'm following</a>
            </li>
            <li class="list-group-item text-center" style="border-bottom: none">
                <a class="card-link" href="{{ route("followers") }}">My followers</a>
            </li>
        </ul>
    </div>
    <script>
        const parrent_node = document.getElementById("image_node_parrent");

        function image_option()
        {
            const html_to_add = `
                 <div class="position-absolute" style="top:20px; left:130px;" id="last_child_to_remove">
                    <button type="submit">Change</button>
                    <button type="submit">Delete</button>
                </div>`;

            parrent_node.insertAdjacentHTML('beforeend', html_to_add);
        }

        function image_without_option()
        {
            parrent_node.removeChild(parrent_node.lastChild);
        }
    </script>
</div>
