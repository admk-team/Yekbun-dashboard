<form id="editForm{{ $movie->id }}" method="POST" action="{{ route('upload-movies.update',$movie->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($movie_category as $movies)
                        <option value="{{ $movies->id }}"{{ $movies->id == $movie->category_id ? 'selected' : '' }}>{{ $movies->category ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Item Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="" name="title" value="{{ $movie->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Image</label>
                    <input type ="file" name="thumbnail" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Upload Movie</label>
                    <input type="file" name="movie[]" class="form-control" multiple  />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" name="status">
                        {{-- <option value="" >Select Status</option> --}}
                        <option value="0" {{ $movie->status == 0 ? 'selected' : '' }}>Unpublish</option>
                        <option value="1" {{ $movie->status == 1 ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>
            
            </div>
        </div>
    </div>

</form>