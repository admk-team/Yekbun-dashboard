@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Music /</span> Add Music
</h4>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div id="sticky-wrapper" class="sticky-wrapper" style="height: 86.9375px;"><div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row" style="">
          <h5 class="card-title mb-sm-0 me-2">Music</h5>
          <div class="action-btns">
            <a href="{{ route('music') }}">
            <button class="btn btn-label-primary me-3">
              <span class="align-middle"> Back</span>
            </button>
        </a>
          </div>
        </div></div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <!-- 1. Delivery Address -->
              <h5 class="mb-4">1. Delivery Address</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="fullname">Music Title</label>
                  <input type="text" id="fullname" class="form-control" placeholder="Jang">
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="email">Writer</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="text" id="email" name="email" placeholder="john" aria-label="john.doe" aria-describedby="email3">
                    <span class="input-group-text" id="email3"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="phone"> Writer Contact Number</label>
                  <input type="text" id="phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941">
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="alt-num"> Writer Alternate Number</label>
                  <input type="text" id="alt-num" class="form-control phone-mask" placeholder="658 799 8941">
                </div>
                <div class="col-12">
                  <label class="form-label" for="address">Description</label>
                  <textarea name="address" class="form-control" id="address" rows="2" placeholder="1456, Mall Road" style="height:200px"></textarea>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
