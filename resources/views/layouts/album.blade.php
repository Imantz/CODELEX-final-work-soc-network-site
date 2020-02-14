<h1 class="ml-3">Album</h1>
@if(isset($albums))
<div class="row flex-wrap ml-3">
    @foreach($albums as $photo)
        <div class="card col-3">
            <img src="{{ asset("storage/". $photo->img) }}" class="card-img-top pt-3">
            <div class="card-body">
                <p class="card-text text-center"><small class="text-muted">Like? Comment?</small></p>
            </div>
        </div>
    @endforeach
</div>
@endif

<div>
    <form action="{{ route("album.create", $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group ml-3 mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
