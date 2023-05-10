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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />
@section('content')
<div class="d-flex justify-content-between">
  <div>
      <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Language /</span> All Language
      </h4>
  </div>
  <div class="">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createlanguageModal">Add Language</button>
  </div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">List of Language</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Icon</th>
            <th>Language</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if(count($languages))
          @foreach($languages as $language)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              @switch($language->icon)
                @case('AE')
                  <img src="{{ asset('assets/img/AE.png') }}">
                  @break
                  @case('GB')
                  <img src="{{ asset('assets/img/GB.png') }}">
                  @break
                  @case('US')
                  <img src="{{ asset('assets/img/US.png') }}">
                  @break
                  @case('FR')
                  <img src="{{ asset('assets/img/FR.png') }}">
                  @break
                  @case('DE')
                  <img src="{{ asset('assets/img/DE.png') }}">
                  @break
                  @case('IT')
                  <img src="{{ asset('assets/img/IT.png') }}">
                  @break
                  @case('ES')
                  <img src="{{ asset('assets/img/ES.png') }}">
                  @break
                @default
                  
              @endswitch
              {{ $language->icon  ?? '' }}
            </td>
            <td>{{ $language->title ?? '' }}</td>
            <td>
              <div class="">
                <span data-bs-toggle="modal" data-bs-target="#editlanguageModal{{ $language->id }}">
                    <button class="btn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit"><i class="bx bx-edit"></i></button>
                </span>
                <form action="{{ route('language.destroy', $language->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                </form>
                <x-modal id="editlanguageModal{{$language->id}}" title="Update Language" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{$language->id}}" size="md">
                  @include('content.include.movies.editForm')
                </x-modal>
              </div>
            </td>
          </tr>
       @endforeach
       @else
       <tr>
        <td class="text-center" colspan="8">No Language found.</td>
       </tr>
       @endif
        </tbody>
      </table>
    </div>
  </div>
 
<x-modal id="createlanguageModal" title="Create Language" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="md">
@include('content.include.language.createForm')
</x-modal>

@section('page-script')
<script>
    function confirmAction(event, callback) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?'
            , text: "Are you sure you want to delete this?"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'Yes, delete it!'
            , customClass: {
                confirmButton: 'btn btn-danger me-3'
                , cancelButton: 'btn btn-label-secondary'
            }
            , buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                callback();
            }
        });
    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>

@endsection
@endsection
