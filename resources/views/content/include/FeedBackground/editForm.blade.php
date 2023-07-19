<form id="editForm{{ $background->id }}" method="POST" action="{{ route('backgrond-feed.update',$background->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Backround Image</label>
                    <input type="file" id="inputTitle" class="form-control" placeholder="Title" name="image.{{ $background->id }}">
                    <input type="hidden" id="image_id" name="image_id" value="image_id"/>
                    @error('image')
                    <span class="text-danger">Image must be 375 * 314 dimensions.</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
