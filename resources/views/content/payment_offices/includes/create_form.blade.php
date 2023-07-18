<form id="createForm" action="{{ route('settings.payment-offices.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="showCreateFormModal" value="1">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputOfficeName">Office Name</label>
                    <input type="text" id="inputOfficeName" name="office_name" class="form-control" value="{{ old('office_name') }}" placeholder="Office Name">
                    @error('office_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputName">Name</label>
                    <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputLastName">Last Name</label>
                    <input type="text" id="inputLastName" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name">
                    @error('last_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="col-md-12">
                    <label class="form-label" for="inputEmail">Email</label>
                    <input type="text" id="inputEmail" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="col-md-12">
                    <label class="form-label" for="inputPhone">Phone No</label>
                    <input type="text" id="inputPhone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Phone No">
                    @error('phone')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputCountry">Country</label>
                    <select name="country" class="form-control">
                        <option  value="{{ $country->id }}" readonly>{{ $country->name ?? '' }}</option>
                    </select>
                    @error('country')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputCity">City</label>
                    <select  name="city" class="form-control">
                        <option value="">Select city</option>
                    @foreach($cities as $city)
                       <option value="{{ $city->id }}">{{ $city->name ?? '' }}</option>
                    @endforeach
                </select>
                    @error('city')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputAddress">Address</label>
                    <input type="text" id="inputAddress" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                    @error('address')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputImage">Upload Image</label>
                    <input type="file" name="image" id="inputImage" class="form-control">
                    @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>