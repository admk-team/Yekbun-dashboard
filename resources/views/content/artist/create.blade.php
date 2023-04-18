@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Artist /</span> Add Artist
</h4>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div id="sticky-wrapper" class="sticky-wrapper" style="height: 86.9375px;"><div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row" style="">
          <h5 class="card-title mb-sm-0 me-2">Artist</h5>
          <div class="action-btns">
            <a href="{{ route('artist.index') }}">
            <button class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </button>
        </a>
          </div>
        </div></div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form method="POST" action="{{ route('artist.store') }}" enctype="multipart/form-data">
                @csrf
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
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
