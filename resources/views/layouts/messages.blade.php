@extends("auth-user")
@section("wall")
    <div>
        @if (session('msg_flash'))
            <div class="alert alert-success">
                {{ session('msg_flash') }}
            </div>
        @endif
        @foreach($user->messagesReceived as $msg)
            <div class="card mb-2">
                <div class="card-body" id="message_to_answer_{{ $msg->id }}">
                    <p>{{ $msg->title }}</p>
                    <p>{{ $msg->body }}</p>
                    <button type="submit" disabled>Delete</button>
                    <button id="answer_button_{{$msg->id}}" onclick="answer({{$msg->id}})">Answer</button>

                </div>

            </div>
            @endforeach
            <script>
                let message_open = [];

                function answer(message_id){
                    const message_parrent = document.getElementById(`message_to_answer_${message_id}`);
                    const answer_button = document.getElementById(`answer_button_${message_id}`);
                    const answer_field = `
                           <div class="card-body">
                                <form action="{{ route("message.send", $msg->id) }}" method="POST">
                                    @csrf
                                    <textarea class="w-100" name="body" id="" rows="5"></textarea>
                                    <button class="mr-auto" type="submit">Send</button>
                                </form>
                           </div>
                    `;

                    if(!message_open.includes(message_id)){
                        message_parrent.insertAdjacentHTML('beforeend', answer_field);
                        message_open.push(message_id);
                        answer_button.style.display = "none";
                        answer_button.disabled = true;
                    }
                }


            </script>
    </div>
    @endsection
