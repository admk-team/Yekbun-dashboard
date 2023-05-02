<form id="editForm{{ $category->id }}" action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="showEditFormModal{{ $category->id }}" value="1">
    <input type="hidden" name="target" value="{{ $target }}">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputName{{ $category->id }}">Name</label>
                    <input type="text" id="inputName{{ $category->id }}" name="name" class="form-control" value="{{ old('name')?? $category->name }}" placeholder="Category Name">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>