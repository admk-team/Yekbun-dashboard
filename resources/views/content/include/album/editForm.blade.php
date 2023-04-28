<form id="editForm{{ $albums->id }}" method="POST" action="{{ route('album.update',$albums->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Artist</label>
                    <select class="form-select" aria-label="Default select example" name="artist_id">
                        <option selected>Select</option>
                        @foreach($artist as $artists)
                        <option value="{{ $artists->id }}" {{ $artists->id == $albums->artist_id ? 'selected' : '' }}>{{ $artists->first_name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" name="image" class="form-control" id="image" />
                    <img src="{{ asset('storage/'.$albums->image) }}" width="70" height="70"> 
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Album</label>
                    <input type="file" name="album[]" class="form-control" id="album" multiple />
                    @foreach($arr as $key=> $value)
                    <?php
                      $getalbum  = $value[$key] ?? null; 
                    ?>
                     <audio controls>
                        <source src="{{ asset('storage/'.$getalbum) }}">
                     </audio>
                    @endforeach
                    @error('album')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>  
            </div>
        </div>
    </div>
</form>