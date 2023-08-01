<form id="editForm{{ $bazar->id }}" method="POST" action="{{ route('bazar.update',$bazar->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h5 class="mb-4">Bazar</h5>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Category Name</label>
                    <select class="form-select" aria-label="Default select example" name="category_id" onchange="loadSubCategories(this)">
                        <option value="" selected>Select</option>
                        @foreach($bazar_category as $category)
                        <option value="{{ $category->id }}" {{ $bazar->category_id == $category->id ? 'selected' : '' }}>{{ $category->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="subcategories-container">
                      <label class="form-label" for="fullname">Sub Category</label>
                      <select class="form-select" aria-label="Default select example" name="subcategory_id" {{ $bazar->category_id? '': 'disabled' }}>
                          @if (! $bazar->category_id)
                            <option selected value="">Select</option>
                          @else
                            @foreach ($bazar_category->first(fn ($value, $key) => $value->id == $bazar->category_id)
                                    ->sub_categories as $subCat)
                                    <option value="{{ $subCat->id }}" {{ $subCat->id == $bazar->subcategory_id? 'selected': '' }}>{{ $subCat->name }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control" name="title" value="{{ $bazar->title ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" name="image[]" class="form-control" id="image" multiple />
                    {{-- <img src="{{ asset('storage/'. $bazar->image) }}" height="150"> --}}
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="">Warranty</label>
                    <select name="warranty" class="form-select">
                        <option value="0"{{ $bazar->warranty ==0 ? 'selected' : '' }}>No</option>
                        <option value="1"{{ $bazar->warranty ==1 ? 'selected' : '' }}>Yes</option>

                    </select>

                </div>
                <div class="col-md-12">
                    <label class="form-lable" for="status">Status</label>
                    {{-- <option>Select Status</option> --}}
                    <select name="status" class="form-select">
                    <option value="0" {{ $bazar->status == 0 ? 'selected' : '' }}>UnPublish</option>
                    <option value="1" {{ $bazar->status == 1 ? 'selected' : '' }}>Publish</option>
                </select>
                </div> 
            </div>
        </div>
    </div>

</form>