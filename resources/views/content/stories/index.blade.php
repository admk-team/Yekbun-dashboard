@extends('layouts/layoutMaster')

@section('title', 'Stories List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection


@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $app? ucfirst(($app?? '')) . 'App': 'Stories' }} /</span> Stories List
</h4>
</div>
<div class="">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Story</button>
</div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Stories List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Media</th>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($stories as $story)
          <tr>
            <td>
              <img class="rounded" src="{{ asset('storage/' . $story->thumbnail_path) }}" height="100" width="100" alt="">
            </td>
            <td>{{ $story->title }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $story->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                  <form action="{{ route('stories.destroy', $story->id) }}" method="post" onsubmit="confirmAction(event, () => event.target.submit())">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>
              <x-modal
                id="editModal{{ $story->id }}"
                title="Edit Story" 
                saveBtnText="Update"
                saveBtnType="submit"
                saveBtnForm="editForm{{ $story->id }}"
                size="xl"
                :show="old('showEditFormModal'.$story->id)? true: false"
              >
                @include('content.stories.includes.edit_form')
              </x-modal>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No Stories found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <x-modal
    id="createModal"
    title="Add Story" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    size="xl"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.stories.includes.create_form')
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
@endsection