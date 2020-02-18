<div class="ml-3">
        <div class="card">
            <img class="card-img-top p-3" src="{{ asset("storage/". $album->img) }}" height="500px">
                <div class="card-body">

                    <p class="card-text text-center"><small class="text-muted">Like? Comment?</small></p>
                    <form action="{{ route("album.delete", [$album]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="danger" type="submit">{{ __("Delete") }}</button>
                    </form>
                </div>
        </div>
</div>
