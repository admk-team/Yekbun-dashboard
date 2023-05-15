@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')

{{-- Nav TAb --}}
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">System Logs</span>
</h4>
</div>
{{-- <div class="">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createmusicModal">Add Music</button>
</div> --}}
</div>
<div class="card mb-4">
    <h5 class="card-header">Admin Activity Timeline</h5>
    <div class="card-body">
      <ul class="timeline">
        <li class="timeline-item timeline-item-transparent">
          <span class="timeline-point timeline-point-primary"></span>
          <div class="timeline-event">
            <div class="timeline-header mb-1">
              <h6 class="mb-0">12 Invoices have been paid</h6>
              <small class="text-muted">12 min ago</small>
            </div>
            <p class="mb-2">Invoices have been paid to the company</p>
            <div class="d-flex">
              <a href="javascript:void(0)" class="me-3">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/misc/pdf.png" alt="PDF image" width="15" class="me-2">
                <span class="fw-bold text-body">invoices.pdf</span>
              </a>
            </div>
          </div>
        </li>
        <li class="timeline-item timeline-item-transparent">
          <span class="timeline-point timeline-point-warning"></span>
          <div class="timeline-event">
            <div class="timeline-header mb-1">
              <h6 class="mb-0">Client Meeting</h6>
              <small class="text-muted">45 min ago</small>
            </div>
            <p class="mb-2">Project meeting with john @10:15am</p>
            <div class="d-flex flex-wrap">
              <div class="avatar me-3">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
              </div>
              <div>
                <h6 class="mb-0">Lester McCarthy (Client)</h6>
                <span class="text-muted">CEO of ThemeSelection</span>
              </div>
            </div>
          </div>
        </li>
        <li class="timeline-item timeline-item-transparent">
          <span class="timeline-point timeline-point-info"></span>
          <div class="timeline-event">
            <div class="timeline-header mb-1">
              <h6 class="mb-0">Create a new project for client</h6>
              <small class="text-muted">2 Day Ago</small>
            </div>
            <p class="mb-2">5 team members in a project</p>
            <div class="d-flex align-items-center avatar-group">
              <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
              </div>
              <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Marrie Patty" data-bs-original-title="Marrie Patty">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/12.png" alt="Avatar" class="rounded-circle">
              </div>
              <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Jimmy Jackson" data-bs-original-title="Jimmy Jackson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/9.png" alt="Avatar" class="rounded-circle">
              </div>
              <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Kristine Gill" data-bs-original-title="Kristine Gill">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
              </div>
              <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Nelson Wilson" data-bs-original-title="Nelson Wilson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/14.png" alt="Avatar" class="rounded-circle">
              </div>
            </div>
          </div>
        </li>
        <li class="timeline-item timeline-item-transparent">
          <span class="timeline-point timeline-point-success"></span>
          <div class="timeline-event">
            <div class="timeline-header mb-1">
              <h6 class="mb-0">Design Review</h6>
              <small class="text-muted">5 days Ago</small>
            </div>
            <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
          </div>
        </li>
        <li class="timeline-end-indicator">
          <i class="bx bx-check-circle"></i>
        </li>
      </ul>
    </div>
  </div>

@endsection
