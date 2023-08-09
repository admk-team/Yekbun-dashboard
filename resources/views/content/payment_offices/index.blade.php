@extends('layouts/layoutMaster')

@section('title', 'Settings - Add / Manage Payment Offices')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
<script>
  const dropZoneInitFunctions = [];
</script>
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Settings /</span> Add / Manage Payment Offices
</h4>
</div>
<div class="">
    <!-- <a href="{{ route('donations.organizations.create') }}">
      <button class="btn btn-primary">Add Organization</button>
    </a> -->
</div>
</div>

<style>
  .office-card {
    width: 120px;
    height: 125px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0.125rem 0.25rem rgba(161, 172, 184, 0.4) !important;
  }

  .office-card .img {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
  }

  .office-card .actions {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 2;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0,0,0, 0);
    transition: all .1s;
  }

  .office-card .actions .actions-inner {
    display: none;
  }

  .office-card:hover .actions {
    background-color: rgba(0,0,0, .4);
  }

  .office-card:hover .actions .actions-inner {
    display: block;
  }

  .office-card .actions .actions-inner {
    
  }
</style>

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">Payment Office List</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add Office</button>
    </div>
    <hr class="m-0">
    <div class="card-body d-flex flex-wrap gap-3" style="min-height: 282px">
      @forelse($paymentOffices as $office)
        <div class="office-card bg-secondary rounded">
          <div class="office-card-body">
            <img class="img" src="{{ asset('storage/' . $office->image_path) }}" alt="">
            <div class="actions">
              <div class="actions-inner">
                <!-- Edit -->
                <span data-bs-toggle="modal" data-bs-target="#editModal{{ $office->id }}" class="me-2">
                  <button class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit">
                    <i class="bx bx-edit"></i>
                  </button>
                </span>

                <!-- Delete -->
                <form action="{{ route('settings.payment-offices.destroy', $office->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash"></i></button>
                </form>
              </div>
            </div>
          </div>
          
          <x-modal
            id="editModal{{ $office->id }}"
            title="Edit Payment Office" 
            saveBtnText="Update"
            saveBtnType="submit"
            saveBtnForm="editForm{{ $office->id }}"
            size="md"
            :show="old('showEditFormModal'.$office->id)? true: false"
          >
            @include('content.payment_offices.includes.edit_form')
          </x-modal>
        </div>
      @empty
      <tr>
        <td class="text-center" colspan="8"><b>No Offices found.<b></td>
      </tr>
      @endforelse
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  {{--
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">Payment Office List</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add Office</button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Office Name</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($paymentOffices as $office)
          <tr>
            <td>{{ $office->id }}</td>
            <td>{{ $office->office_name }}</td>
            <td>
              <div>
                <!-- Edit -->
                <span data-bs-toggle="modal" data-bs-target="#editModal{{ $office->id }}">
                  <button class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit">
                    <i class="bx bx-edit"></i>
                  </button>
                </span>

                <!-- Delete -->
                <form action="{{ route('settings.payment-offices.destroy', $office->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                </form>
              </div>
              
              <x-modal
                id="editModal{{ $office->id }}"
                title="Edit Payment Office" 
                saveBtnText="Update"
                saveBtnType="submit"
                saveBtnForm="editForm{{ $office->id }}"
                size="md"
                :show="old('showEditFormModal'.$office->id)? true: false"
              >
                @include('content.payment_offices.includes.edit_form')
              </x-modal>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No Offices found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
  --}}

  <x-modal
    id="createModal"
    title="Add Payment Office" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    size="md"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.payment_offices.includes.create_form')
  </x-modal>
@endsection

@section('page-script')
<script>
  function confirmAction(event, callback) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to delete this?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-danger me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        callback();
      }
    });
  }
</script>
<script>
  function drpzone_init() {
      dropZoneInitFunctions.forEach(callback => callback());
  }
</script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js" onload="drpzone_init()"></script>
@endsection