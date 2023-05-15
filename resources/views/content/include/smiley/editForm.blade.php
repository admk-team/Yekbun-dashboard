<form id="editForm{{$smiley->id}}" method="POST" action="{{ route('smiley.update',$smiley->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label" for="fullname">Smiley</label>
                    <input type="file" id="smiley" class="form-control" name="smiley" accept="" />
                    <img src={{asset('storage/'.$smiley->smiley_path)}} width="100"/>
                    @error('smiley')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
</form>


