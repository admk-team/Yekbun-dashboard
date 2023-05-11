@extends('layouts/layoutMaster')

@section('title', 'Events - Requests')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Events /</span> All Requests
</h4>
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
    <h5 class="card-header">Event Requests</h5>
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
            <td>{{ isset($event->user)? $event->user->name: '' }}</td>
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

                {{--<!-- Edit -->
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
                </form>--}}
                {{--<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('events.edit', $event->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="bx bx-transfer-alt me-1"></i> Change Status
                  </button>
                  <form action="{{ route('events.destroy', $event->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>--}}

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
@endsection
