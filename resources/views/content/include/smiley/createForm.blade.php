<form id="createForm" method="POST" action="{{ route('smiley.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="smiley" class="form-control" name="title"  />
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Smiley Code</label>
                    <input type="text" id="smiley" class="form-control" name="code"  />
                    @error('code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Smiley</label>
                    <input type="file" id="smiley" class="form-control" name="smiley" accept="" />
                    @error('smiley')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
</form>


