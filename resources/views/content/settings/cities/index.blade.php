@extends('layouts/layoutMaster')

@section('title', 'Cities - List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
<style>
    .select2-container {
        z-index: 5000;
    }
</style>
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Settings /</span> Add / Manage City
</h4>
</div>
<div class="">
    <!-- <a href="{{ route('donations.organizations.create') }}">
      <button class="btn btn-primary">Add Organization</button>
    </a> -->
</div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">City List</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add City</button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Country Name</th>
            <th>Province Name</th>
            <th>Zipcode</th>
            <th>City Name</th>
            <th>Total People</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($cities as $city)
          <tr>
            <td>{{ $city->id }}</td>
            <td>{{ $city->country? $city->country->name: '' }}</td>
            <td>{{ $city->region? $city->region->name: '' }}</td>
            <td>{{ $city->zipcode }}</td>
            <td>{{ $city->name }}</td>
            <td>{{ $city->users->count() }}</td>
            <td>
              <div>
                <!-- Edit -->
                <span data-bs-toggle="modal" data-bs-target="#editModal{{ $city->id }}">
                  <button class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit">
                    <i class="bx bx-edit"></i>
                  </button>
                </span>

                <!-- Delete -->
                <form action="{{ route('settings.cities.destroy', $city->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                </form>
              </div>
              {{--
              <div class="dropdown d-inline-block">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <!-- <a class="dropdown-item" href="{{ route('donations.organizations.edit', $organization->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $organization->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                  <form action="{{ route('donations.organizations.destroy', $organization->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>
              --}}
              <x-modal
                id="editModal{{ $city->id }}"
                title="Edit City" 
                saveBtnText="Update"
                saveBtnType="submit"
                saveBtnForm="editForm{{ $city->id }}"
                size="sm"
                :show="old('showEditFormModal'.$city->id)? true: false"
              >
                @include('content.settings.cities.includes.edit_form')
              </x-modal>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="7"><b>No cities found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <x-modal
    id="createModal"
    title="Add City" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    size="md"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.settings.cities.includes.create_form')
  </x-modal>
@endsection

@section('page-script')
@parent
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
  const regions = {
    @foreach ($countries as $country)
    {{ $country->id }}: [
      @foreach ($country->regions as $region)
      {
        id: {{ $region->id }},
        name: '{{ $region->name }}'
      },
      @endforeach
    ],
    @endforeach
  };
</script>

<script>
  function loadRegions(event) {
    const countryId = event.target.value;
    const regionSelectInput = event.target.closest('form').querySelector('[name=region_id]');
    regionSelectInput.innerHTML = '';

    const option = document.createElement('option');
    option.value = "";
    option.text = "Choose";
    regionSelectInput.add(option);

    regions[countryId].forEach(region => {
      const option = document.createElement('option');
      option.value = region.id;
      option.text = region.name;
      regionSelectInput.add(option);
    });
  }
</script>
@endsection