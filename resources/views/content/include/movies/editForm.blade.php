<form id="editForm{{ $language->id }}" method="POST" action="{{ route('language.update',$language->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Icon</label>
                    <select class="form-select" name="icon" id="mySelect">
                            <option selected="">Choose a language</option>
                            <option value="AE" data-img-src="{{ asset('assets/img/arabic_flag1.jpg') }}" {{ $language->icon == "AE" ? 'selected' : ''  }}>Arabic</option>
                            <option value="GB" {{ $language->icon == "GB" ? 'selected' : '' }}>English (GB)</option>
                            <option value="US" data-img-src="img/US.png" {{ $language->icon == "US" ? 'selected' : '' }}>English (USA)</option>
                            <option value="FR" data-img-src="img/FR.png" {{ $language->icon == "FR" ? 'selected' : '' }}>French</option>
                            <option value="DE" data-img-src="img/DE.png" {{ $language->icon == "DE" ? 'selected' : '' }}>Deutsch</option>
                            <option value="IT" data-img-src="img/IT.png" {{ $language->icon == "IT" ? 'selected' : '' }}>Italian</option>
                            <option value="ES" data-img-src="img/ES.png" {{ $language->icon == "ES" ? 'selected' : '' }}>Spanish</option>
                    </select>             
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" name="title" class="form-control" id="audioFile" value="{{ $language->title ?? '' }}"  />
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="status">Status</label>
                    <select name="status" class="form-select">
                        <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>Unpublish</option>
                        <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>
           
             
            </div>
        </div>
    </div>

</form>
