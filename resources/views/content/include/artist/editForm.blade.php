<form id="editForm{{ $artists->id }}" method="POST" action="{{ route('artist.update',$artists->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label" for="fullname">Gender</label>
                    <select name="gender" class="form-select">
                        <option>Select Gender</option>
                        @if($artists->gender == 'male')
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        @else
                        <option value="female" selected>Female</option>
                        <option value="male">Male</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="fullname">First Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="first_name" value="{{ $artists->first_name ?? '' }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Last Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="last_name" value="{{ $artists->last_name ?? '' }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">City</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="city" value="{{ $artists->city ?? '' }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Dob</label>
                    <input type="date" id="fullname" class="form-control" name="dob" value="{{ $artists->dob ?? '' }}">
                </div>
              
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" id="fullname" class="form-control" name="image">
                    {{-- <img src="{{ asset('storage/'.$artists->image) }}" height="150" width="300" class="mt-1"> --}}
                </div>
            </div>
        </div>
    </div>
</form>