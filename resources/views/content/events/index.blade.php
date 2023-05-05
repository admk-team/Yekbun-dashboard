@extends('layouts/layoutMaster')

@section('title', 'Events - List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Events /</span> All Events
</h4>
</div>
<div class="">
    {{-- <a href="{{ route('events.create') }}">
      <button class="btn btn-primary">Add Event</button>
    </a> --}}
</div>
</div>

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Event Requests</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">21,459</h4>
              <small class="text-success">(+29%)</small>
            </div>
            <small>Event Requests</small>
          </div>
          <span class="badge bg-label-primary rounded p-2">
            <i class="bx bx-user bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Events</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">19,860</h4>
              <small class="text-danger">(-14%)</small>
            </div>
            <small>Last week analytics</small>
          </div>
          <span class="badge bg-label-success rounded p-2">
            <i class="bx bx-group bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Past Events</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">237</h4>
              <small class="text-success">(+42%)</small>
            </div>
            <small>Last week analytics</small>
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-user-voice bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">Events List</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add Event</button>
    </div>
    <div class="table-responsive text-nowrap">
    <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Created By</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Created Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($events as $event)
          <tr>
            <td>{{ $event->title }}</td>
            <td>{{ isset($event->category)? $event->category->name: '' }}</td>
            <td>{{ isset($event->user)? $event->user->name: 'Admin' }}</td>
            <td>{{ $event->start_time? $event->start_time->format('F jS, Y h:i a'): '' }}</td>
            <td>{{ $event->end_time? $event->end_time->format('F jS, Y h:i a'): '' }}</td>
            <td>{{ $event->created_at->format('F jS, Y h:i a') }}</td>
            <td>
              @if ((int) $event->status === 0)
                <span class="badge bg-label-primary me-1">Pending</span>
              @elseif ((int) $event->status === 1)
                <span class="badge bg-label-success me-1">Approved</span>
              @else
                <span class="badge bg-label-danger me-1">Rejected</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <span data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                  <button class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Change Status">
                    <i class="bx bx-transfer"></i>
                  </button>
                </span>

                <!-- Edit -->
                <span data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}">
                  <button class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit">
                    <i class="bx bx-edit"></i>
                  </button>
                </span>

                <!-- Delete -->
                <form action="{{ route('events.destroy', $event->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                </form>

                {{--
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                  <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="bx bx-transfer-alt me-1"></i> Change Status
                  </button>
                  <form action="{{ route('events.destroy', $event->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
                --}}
              </div>

              <x-modal
                id="editModal{{ $event->id }}"
                title="Edit Event" 
                size="xl"
                :show="old('showEditFormModal'.$event->id)? true: false"
                :showSaveBtn="false"
                :showFooter="false"
                :titleCentered="true"
                titleTag="h3"
              >
                @include('content.events.includes.edit_form')
              </x-modal>

              <!-- Modal -->
              <div class="modal fade" id="changeStatusModal" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                  <form action="{{ route('events.update', $event->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Change Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-check mt-3">
                          <input name="status" class="form-check-input" type="radio" value="0" id="pending" {{ (int) $event->status === 0? 'checked': '' }}>
                          <label class="form-check-label" for="pending">
                            Pending
                          </label>
                        </div>
                        <div class="form-check mt-3">
                          <input name="status" class="form-check-input" type="radio" value="1" id="approved" {{ (int) $event->status === 1? 'checked': '' }}>
                          <label class="form-check-label" for="approved">
                            Approved
                          </label>
                        </div>
                        <div class="form-check mt-3">
                          <input name="status" class="form-check-input" type="radio" value="2" id="rejected" {{ (int) $event->status === 2? 'checked': '' }}>
                          <label class="form-check-label" for="rejected">
                            Rejected
                          </label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No requests found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <x-modal
    id="createModal"
    title="Add Event" 
    size="xl"
    :show="old('showCreateFormModal')? true: false"
    :showSaveBtn="false"
    :showFooter="false"
    :titleCentered="true"
    titleTag="h3"
  >
    @include('content.events.includes.create_form')
  </x-modal>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>

<script>
  const wizardNumbered = document.querySelector('.wizard-numbered'),
    wizardNumberedBtnNextList = [].slice.call(wizardNumbered.querySelectorAll('.btn-next')),
    wizardNumberedBtnPrevList = [].slice.call(wizardNumbered.querySelectorAll('.btn-prev')),
    wizardNumberedBtnSubmit = wizardNumbered.querySelector('.btn-submit');

  if (typeof wizardNumbered !== undefined && wizardNumbered !== null) {
    const numberedStepper = new Stepper(wizardNumbered, {
      linear: false
    });
    if (wizardNumberedBtnNextList) {
      wizardNumberedBtnNextList.forEach(wizardNumberedBtnNext => {
        wizardNumberedBtnNext.addEventListener('click', event => {
          numberedStepper.next();
        });
      });
    }
    if (wizardNumberedBtnPrevList) {
      wizardNumberedBtnPrevList.forEach(wizardNumberedBtnPrev => {
        wizardNumberedBtnPrev.addEventListener('click', event => {
          numberedStepper.previous();
        });
      });
    }
    if (wizardNumberedBtnSubmit) {
      wizardNumberedBtnSubmit.addEventListener('click', event => {
        //alert('Submitted..!!');
      });
    }
  }
</script>

<script>
  (function () {
    // Full Toolbar
  // --------------------------------------------------------------------
  const fullToolbar = [
    [
      {
        font: []
      },
      {
        size: []
      }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
      {
        color: []
      },
      {
        background: []
      }
    ],
    [
      {
        script: 'super'
      },
      {
        script: 'sub'
      }
    ],
    [
      {
        header: '1'
      },
      {
        header: '2'
      },
      'blockquote',
      'code-block'
    ],
    [
      {
        list: 'ordered'
      },
      {
        list: 'bullet'
      },
      {
        indent: '-1'
      },
      {
        indent: '+1'
      }
    ],
    [{ direction: 'rtl' }],
    ['link', 'image', 'video', 'formula'],
    ['clean']
  ];
  const fullEditor = new Quill('#inputDescription', {
    bounds: '#full-editor',
    placeholder: 'Type Something...',
    modules: {
      formula: true,
      toolbar: fullToolbar
    },
    theme: 'snow'
  });

  }());
</script>
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