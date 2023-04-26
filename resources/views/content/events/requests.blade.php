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
              @if ($event->status === 0)
                <span class="badge bg-label-primary me-1">Pending</span>
              @elseif ($event->status === 1)
                <span class="badge bg-label-success me-1">Approved</span>
              @else
                <span class="badge bg-label-danger me-1">Rejected</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
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
              </div>

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
                          <input name="status" class="form-check-input" type="radio" value="0" id="pending" {{ $event->status === 0? 'checked': '' }}>
                          <label class="form-check-label" for="pending">
                            Pending
                          </label>
                        </div>
                        <div class="form-check mt-3">
                          <input name="status" class="form-check-input" type="radio" value="1" id="approved" {{ $event->status === 1? 'checked': '' }}>
                          <label class="form-check-label" for="approved">
                            Approved
                          </label>
                        </div>
                        <div class="form-check mt-3">
                          <input name="status" class="form-check-input" type="radio" value="2" id="rejected" {{ $event->status === 2? 'checked': '' }}>
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
