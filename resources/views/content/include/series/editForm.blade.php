<form id="editForm{{ $serie->id }}" method="POST" action="{{ route('series.series.update',$serie->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Lorem" name="title" value="{{ $serie->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="fullname">Thumbnail</label>
                    <input type="file" id="fullname" class="form-control" placeholder="" name="thumbnail">
                    <img src="{{asset('storage/'.$serie->thumbnail)}}" width="100" height="100">
                    @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Series</label>
                    <input type="file" name="series[]" class="form-control" id="video" accept="video/*" multiple />
                    @foreach($arr as $key => $value)
                    @if(file_exists(public_path('storage/'.$value)))
                    <video width="100" height="100" controls preload="none">
                        <source src="{{ asset('storage/'.$value) }}">
                    </video>
                    @endif
                    @endforeach

                    @error('video')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        @foreach($series_category as $series)
                        <option value="{{ $series->id }}" {{ $series->id == $serie->category_id ? 'selected' : '' }}>{{ $series->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Description</label>
                    <textarea class="form-control" placeholder="" name="description">{{ $serie->description ?? '' }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</form>
