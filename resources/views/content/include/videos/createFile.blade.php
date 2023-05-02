  
  <form id="createForm" method="POST" action="{{ route('upload-video.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="fullname">Thumbnail</label>
            <input type="text" id="fullname" class="form-control" placeholder="" name="thumbnail">
            @error('thumbnail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label" for="fullname">Uplaod Video</label>
            <input type="file" name="video[]" class="form-control" id="image" accept="video/*"  multiple/>
            @error('video')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label" for="fullname">Title</label>
            <input type="text" id="fullname" class="form-control" placeholder="" name="title">
            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label" for="fullname">Category</label>
            <select class="form-select" aria-label="Default select example" name="category_id">
              <option>Select Category</option>
              @foreach($video_category as $video)
              <option value="{{ $video->id }}">{{ $video->category ?? '' }}</option>
              @endforeach
            </select>
            @error('category_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-12">
            <label class="form-label" for="address">Description</label>
            <textarea class="form-control" id="address" name="description" rows="2" placeholder="Lorem"
              style="height:200px"></textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button class="mt-1 btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </form>