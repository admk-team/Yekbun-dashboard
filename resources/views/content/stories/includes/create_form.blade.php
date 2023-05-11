<form id="createForm" action="{{ route('stories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="showCreateFormModal" value="1">
    <input type="hidden" name="app" value="{{ $app?? 'main' }}">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Title</label>
                    <input type="text" id="inputTitle" name="title" class="form-control" value="{{ old('title') }}" placeholder="Story Title">
                    @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputMedia">Thumbnail</label>
                    <input type="file" id="inputMedia" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" accept="image/png, image/gif, image/jpeg">
                    @error('thumbnail')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputMedia">Media</label>
                    <input type="file" id="inputMedia" name="media" class="form-control" value="{{ old('media') }}" accept="video/*">
                    @error('media')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>