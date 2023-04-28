<form id="createForm" method="POST" action="{{ route('album.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Artist</label>
                    <select class="form-select" aria-label="Default select example" name="artist_id">
                        <option selected>Select</option>
                        @foreach($artist as $artists)
                        <option value="{{ $artists->id }}">{{ $artists->first_name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" name="image" class="form-control" id="image" />
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Album</label>
                    <input type="file" name="album[]" class="form-control" id="album" multiple />
                    @error('album')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>  
                   <div class="col-md-6">
                    <label class="form-label" for="fullname">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected>Select</option>
                        <option value="0">UnPublish</option>
                        <option value="1">Publish</option>
                        
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
  
            </div>
        </div>
    </div>
</form>