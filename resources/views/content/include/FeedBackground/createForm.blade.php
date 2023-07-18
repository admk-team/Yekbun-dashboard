<form id="createForm" method="POST" action="{{ route('backgrond-feed.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="text-center">
                        <span class="text-danger">*** Only upload 375 * 314  pixels ***</span>
                    </div>
                    <label class="form-label" for="inputTitle">Backround Image</label>
                    <input type="file"  class="form-control" placeholder="Title" name="image" id="imageInput">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
