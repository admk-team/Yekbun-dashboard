<form id="editForm{{ $movie->id }}" method="POST" action="{{ route('upload-movies.update',$movie->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Lorem" name="title" value="{{ $movie->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="fullname">Thumbnail</label>
                    <input type="file" id="fullname" class="form-control" placeholder="" name="thumbnail">
                    <img src="{{asset('storage/'.$movie->thumbnail)}}">
                    @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">movie</label>
                    <input type="file" name="movie[]" class="form-control" id="video" accept="video/*" multiple />
                    @foreach($arr as $key => $value)
                    <?php
                       $getmovie = $value[$key] ?? null;
                     ?>
                    <video width="100" height="100" controls>
                        <source src="{{ asset('storage/'.$getmovie) }}">
                    </video>
                    @endforeach

                    @error('video')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        @foreach($movie_category as $movies)
                        <option value="{{ $movies->id }}" {{ $movies->id == $movie->category_id ? 'selected' : '' }}>{{ $movies->category ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Description</label>
                    <textarea class="form-control" placeholder="" name="description">{{ $movie->description ?? '' }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</form>
