<form id="editForm{{ $story->id }}" action="{{ route('stories.update', $story->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="showEditFormModal{{ $story->id }}" value="1">
    <input type="hidden" name="target" value="{{ $app?? 'main' }}">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputName{{ $story->id }}">Title</label>
                    <input type="text" id="inputName{{ $story->id }}" name="name" class="form-control" value="{{ old('name')?? $story->name }}" placeholder="Story Title">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>