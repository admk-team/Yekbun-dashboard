  <form id="createForm" method="POST" action="{{ route('upload-video.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="app" value="{{ $app }}">
      <div class="row">
          <div class="col-lg-12 mx-auto">
              <div class="row g-3">
                  <div class="col-md-12">
                      <label class="form-label" for="fullname">Category</label>
                      <select class="form-select" aria-label="Default select example" name="category_id">
                          <option value="">Select Category</option>
                          @foreach($video_category as $video)
                            @if ($app === 'main')
                                <option value="{{ $video->id }}">{{ $video->category ?? '' }}</option>
                            @else
                                <option value="{{ $video->id }}">{{ $video->name ?? '' }}</option>
                            @endif
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
                      <input type="file" id="fullname" class="form-control" name="thumbnail">
                      @error('thumbnail')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="col-md-12">
                      <label class="form-label" for="fullname">Uplaod Video</label>
                      <input type="file" name="video[]" class="form-control" id="image" accept="video/*" multiple />
                      @error('video')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  {{-- <div class="col-12">
            <label class="form-label" for="address">Description</label>
            <textarea class="form-control" id="address" name="description" rows="2" placeholder="Lorem"
              style="height:200px"></textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div> --}}
          </div>
      </div>
      </div>
  </form>
