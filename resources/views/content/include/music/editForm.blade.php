<form id="editForm{{ $musics->id }}" method="POST" action="{{ route('music.update',$musics->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h5 class="mb-4">Music</h5>
            <div class="row g-3">
                {{-- <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="fullname" class="form-control" name="title" value="{{ $musics->name ?? '' }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Category Name</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Select</option>
                        @foreach($music_category as $audio)
                        <option value="{{ $audio->id }}" {{ $musics->category_id == $audio->id ? 'selected' : '' }}>{{ $audio->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Audio</label>
                    <input type="file" name="audio[]" class="form-control" id="audio" accept="audio/*" multiple />
                    @foreach($arr as $key => $value)
                    <?php
                      $getaudio = $value ?? null; 
                    ?>
                    <audio controls>
                        <source src="{{ asset('storage/'.$getaudio)}}" /></audio>
                    @endforeach
                    @error('audio')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>