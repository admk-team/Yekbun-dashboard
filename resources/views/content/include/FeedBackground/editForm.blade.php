<form id="editForm{{ $background->id }}" method="POST" action="{{ route('backgrond-feed.update',$background->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                {{-- <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Title</label>
                    <input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title" value="{{ $background->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Backround Image</label>
                    <input type="file" id="inputTitle" class="form-control" placeholder="Title" name="image">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
