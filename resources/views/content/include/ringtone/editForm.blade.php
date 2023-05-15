<form id="editForm{{$ringtone->id}}" method="POST" action="{{ route('ringtone.update',$ringtone->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label" for="fullname">Ringtone</label>
                    <input type="file" id="smiley" class="form-control" name="ringtone" accept="" />
                    @error('ringtone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
</form>


