@extends("home")
@section("wall")
    <div>
        <form>
            <div class="card">
                <div class="card-header">Izveidot ierakstu</div>

                <div class="form-group">
                    <textarea style="border: none; resize: none;" class="form-control" id="exampleFormControlTextarea1" placeholder="Any text there.." rows="3"></textarea>
                </div>
                <button style="width: 80px;" class="btn btn-outline-success mb-2 ml-auto mr-2" type="submit" name="">Add</button>
            </div>
        </form>
        <form>
            <div class="card mt-2">

                <div class="form-group p-2">
                    <p>Text, any</p>
                </div>
                <button style="width: 30px;" class="btn btn-outline-danger mb-2 ml-auto mr-2 p-1 rounded-circle" type="submit" name="">X</button>
            </div>
        </form>

        <form>
            <div class="card mt-2">

                <div class="form-group p-2">
                    <p>Text, any</p>
                </div>
                <button style="width: 30px;" class="btn btn-outline-danger mb-2 ml-auto mr-2 p-1 rounded-circle" type="submit" name="">X</button>
            </div>
        </form>


        <form>
            <div class="card mt-2">

                <div class="form-group p-2">
                    <p>Text, any</p>
                </div>
                <button style="width: 30px;" class="btn btn-outline-danger mb-2 ml-auto mr-2 p-1 rounded-circle" type="submit" name="">X</button>
            </div>
        </form>

    </div>
@endsection
