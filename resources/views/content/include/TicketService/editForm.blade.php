<form id="editForm{{ $service->id }}" class="edit-form"  method="POST" action="{{ route('ticket-service.update',$service->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control"  name="title" value="{{ $service->title ?? '' }}" >
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="icon" id="icon" />
                </div>
        </div>
    </div>
    </div>
</form>
