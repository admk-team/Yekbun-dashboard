<form id="editForm{{ $video->id }}" method="POST" action="{{ route('upload_video.update',$video->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Video Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Lorem" name="title" value="{{ $video->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Video</label>
                    <input type="file" name="video[]" class="form-control" id="video" accept="video/*" multiple />
                    @foreach($arr as $key => $value)
                    <?php
                      $getvideo = $value[$key] ?? null; 
                    ?>
                        <video controls width="100">
                        <source src="{{ asset('storage/'.$getvideo) }}"/>
                        </video>
                    @endforeach
                    @error('video')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example" name="artist_id">
                        <option selected>Select</option>
                        @foreach($artist as $artists)
                        <option value="{{ $artists->id }}" {{ $artists->id == $video->category_id ? 'selected' : '' }}>{{ $artists->first_name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</form>