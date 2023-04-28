<form id="createForm" method="POST" action="{{ route('artist.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="fullname">First Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="first_name">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Last Name</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="last_name">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">City</label>
                    <input type="text" id="fullname" class="form-control" placeholder="lorem" name="city">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Dob</label>
                    <input type="date" id="fullname" class="form-control" name="dob">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Gender</label>
                    <select name="gender" class="form-select">
                        <option selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fullname">Image</label>
                    <input type="file" id="fullname" class="form-control" name="image">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</form>