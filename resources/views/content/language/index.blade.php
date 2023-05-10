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
    <h5 class="card-header">List of Movies</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Icon</th>
            {{-- <th>Letters</th> --}}
            <th>Language</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if(count($languages))
          @foreach($languages as $language)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $language->icon  ?? '' }}</td>
            <td>{{ $movie->title ?? '' }}</td>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <span data-bs-toggle="modal" data-bs-target="#editmoviesModal{{ $language->id }}">
                    <button class="btn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit"><i class="bx bx-edit"></i></button>
                </span>

                <form action="{{ route('language.destroy', $language->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                </form>
              </div>
              {{-- <x-modal id="editmoviesModal{{$language->id}}" title="Update Movie" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{$language->id}}" size="md">
                @include('content.include.movies.editForm')
              
              </x-modal> --}}
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
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
@endsection
@endsection
