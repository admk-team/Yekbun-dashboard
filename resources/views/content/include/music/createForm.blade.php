<form id=createForm method="POST" action="{{ route('music.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                {{-- <div class="col-md-6">
                    <label class="form-label" for="fullname">Music Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Lorem" name="title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Select Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected value="">Select</option>
                        @foreach($music_category as $music)
                        <option value="{{ $music->id }}">{{ $music->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Audio</label>
                    <input type="file" name="audio[]" class="form-control" id="audio" accept="audio/*" multiple />
                    @error('audio')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                   <div class="col-md-12">
                    <label class="form-label" for="fullname">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected value="">Select</option>
                        <option value="0">UnPublish</option>
                        <option value="1">Publish</option>
                        
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
  
            </div>
        </div>
    </div>
</form>