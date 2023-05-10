<form id=createForm method="POST" action="{{ route('language.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Icon</label>
                    <select class="form-select" name="icon" id="mySelect">
                            <option selected="">Choose a language</option>
                            <option value="AE" data-img-src="{{ asset('assets/img/arabic_flag1.jpg') }}">Arabic</option>
                            <option value="GB" style="background-image: url('assets/img/arabic_flag1.jpg')">English (GB)</option>
                            <option value="US" data-img-src="img/US.png">English (USA)</option>
                            <option value="FR" data-img-src="img/FR.png">French</option>
                            <option value="DE" data-img-src="img/DE.png">Deutsch</option>
                            <option value="IT" data-img-src="img/IT.png">Italian</option>
                            <option value="ES" data-img-src="img/ES.png">Spanish</option>
                    </select>             
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" name="title" class="form-control" id="audioFile"  />
                    @error('title')
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

