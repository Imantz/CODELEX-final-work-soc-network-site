<h1 class="ml-3">Gallery</h1>

<div class="row flex-wrap ml-3">
    <div class="card col-3">
        <img src="{{ asset("img/default_pokemon.png") }}" class="card-img-top pt-3">
        <div class="card-body">
            <p class="card-text text-center"><small class="text-muted">Like? Comment?</small></p>
        </div>
    </div>
</div>

<div>
    <form action="{{ route("gallery") }}" method="POST">
        @csrf
        <div class="input-group ml-3 mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            <button>Submit</button>
        </div>
    </form>
</div>
