<form id="createForm{{ $show }}" method="POST" action="{{ route('animated-emoji.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <div>
                        <span>***  Only upload 60 * 60  pixels ***</span>
                    </div>
                    <label class="form-label" for="inputTitle">Animated Emoji</label>
                    <input type="file" id="inputTitle" class="form-control" placeholder="Title" name="emoji">
                    @error('emoji')
                    <span class="text-danger">Emoji must be in 60 * 60 dimensions.</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
