<form id="createForm" method="POST" action="{{ route('upload-movies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($movie_category as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->category ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Item Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="" name="title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="fullname">Thumbnail</label>
                    <input type="file" id="fullname" class="form-control"  name="thumbnail">
                    @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Uplaod Movie</label>
                    <input type="file" name="movie[]" class="form-control" id="image" accept="video/*" multiple />
                    @error('video')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" name="status">
                        <option value="" selected>Select Status</option>
                        <option value="0">Unpublish</option>
                        <option value="1">Publish</option>
                    </select>
                </div>
            
            </div>
        </div>
    </div>

</form>