<form id="editForm{{ $story->id }}" action="{{ route('stories.update', $story->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="showEditFormModal{{ $story->id }}" value="1">
    <input type="hidden" name="target" value="{{ $app?? 'main' }}">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle{{ $story->id }}">Title</label>
                    <input type="text" id="inputTitle{{ $story->id }}" name="title" class="form-control" value="{{ old('title')?? $story->title }}" placeholder="Story Title">
                    @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputMedia{{ $story->id }}">Thumbnail</label>
                    <input type="file" id="inputMedia{{ $story->id }}" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" accept="image/png, image/gif, image/jpeg">
                    @error('thumbnail')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputMedia{{ $story->id }}">Media</label>
                    <input type="file" id="inputMedia{{ $story->id }}" name="media" class="form-control" value="{{ old('media') }}" accept="video/*">
                    @error('media')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>