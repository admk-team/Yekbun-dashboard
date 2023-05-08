<form id="createForm" method="POST" action="{{ route('bazar.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                  <div class="col-md-12">
                    <label class="form-label" for="fullname">Category </label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected value="">Select</option>
                        @foreach($bazar_category as $bazar)
                        <option value="{{ $bazar->id }}">{{ $bazar->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Lorem" name="title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
              
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" name="image[]" class="form-control" id="language" multiple />
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="form-lable" for="price">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
              <div class="col-md-12">
                <label class="form-label" for="Status">Status</label>
                <select class="form-select" name="status">
                  <option value="" selected>Select Status</option>
                  <option value="0">Unpublish</option>
                  <option value="1">Publish</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
              </div>
              <div class="col-md-12">
                <label class="form-label" for="Warranty">Warranty</label>
                <select class="form-select" name="warranty">
                  <option value="" selected>Select warranty</option>
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
                @error('warranty')
                <span class="text-danger">{{ $message }}</span>
            @enderror
              </div>
            </div>
        </div>
    </div>

</form>