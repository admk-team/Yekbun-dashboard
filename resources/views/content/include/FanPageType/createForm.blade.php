<form id="createForm" method="POST" action="{{ route('fan-page-type.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Title</label>
                    <input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle">Icon</label>
                    <input type="file" id="inputTitle" class="form-control" placeholder="Title" name="icon">
                    @error('icon')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <label for="Services">Services</label>
                <div class="col-md-2">
                    <label class="col-md-1 col-form-label">Concerts</label>
                    <div class="col-md-11 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" onclick="confirmSettingUpdate(event)" type="checkbox" name="option[]" value="concerts">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-1 col-form-label">Demostration</label>
                    <div class="col-md-11 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" onclick="confirmSettingUpdate(event)" type="checkbox" name="option[]" value="demostration">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-1 col-form-label">Conference</label>
                    <div class="col-md-11 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" onclick="confirmSettingUpdate(event)" type="checkbox" name="option[]" value="conference">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12 col-form-label">Upload Video</label>
                    <div class="col-md-11 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" onclick="confirmSettingUpdate(event)" type="checkbox" name="option[]" value="upload_video">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
