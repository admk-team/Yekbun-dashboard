@extends('layouts/layoutMaster')

@section('title', 'Reports - List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Reports /</span> All Reports
</h4>
</div>
<!-- <div class="">
    <a href="{{ route('reports.create') }}">
      <button class="btn btn-primary">Add Report</button>
    </a>
</div> -->
</div>

<div class="nav-align-left mb-4">
  <ul class="nav nav-pills me-3" role="tablist">
    <li class="nav-item" role="presentation">
      <a type="button" class="nav-link {{ $status === 1? 'active': '' }}" href="?status=solved"  aria-controls="solovedReportsTab" aria-selected="false" tabindex="-1">Solved</a>
    </li>
    <li class="nav-item" role="presentation">
      <a type="button" class="nav-link {{ $status === 0? 'active': '' }}" href="?status=awaiting"  aria-controls="awaitingReportsTab" aria-selected="true">Awaiting</a>
    </li>
    <li class="nav-item" role="presentation">
      <a type="button" class="nav-link {{ $status === 2? 'active': '' }}" href="?status=dismissed"  aria-controls="dismissedReportsTab" aria-selected="true">Dismissed</a>
    </li>
  </ul>
  <div class="tab-content p-0">
   
    <div class="tab-pane fade show active" id="solovedReportsTab" role="tabpanel">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>User</th>
              <th>Reported By</th>
              <th>Reason</th>
              <th>Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse($reports as $report)
            <tr>
              <td>{{ $report->user->name }}</td>
              <td>{{ $report->reportedUser->name }}</td>
              <td>{{ $report->reason }}</td>
              <td>{{ $report->created_at->format('F jS, Y') }}</td>
              <td>
                @if($report->status === 1)
                  <span class="badge bg-label-success me-1">Solved</span>
                @elseif($report->status === 0)
                  <span class="badge bg-label-warning me-1">Awaiting</span>
                @elseif($report->status === 2)
                  <span class="badge bg-label-danger me-1">Dismissed</span>
                @endif
              </td>
              <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                      Change Status
                    </button>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="changeStatusModal" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                    <form action="{{ route('reports.update', $report->id) }}" method="post">
                      @method('PUT')
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalCenterTitle">Change Status</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-check mt-3">
                            <input name="status" class="form-check-input" type="radio" value="0" id="awaiting" {{ $report->status === 0? 'checked': '' }}>
                            <label class="form-check-label" for="awaiting">
                              Awaiting
                            </label>
                          </div>
                          <div class="form-check mt-3">
                            <input name="status" class="form-check-input" type="radio" value="1" id="solved" {{ $report->status === 1? 'checked': '' }}>
                            <label class="form-check-label" for="solved">
                              Solved
                            </label>
                          </div>
                          <div class="form-check mt-3">
                            <input name="status" class="form-check-input" type="radio" value="2" id="dismissed" {{ $report->status === 2? 'checked': '' }}>
                            <label class="form-check-label" for="dismissed">
                              Dismissed
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
              <td class="text-center" colspan="5"><b>No reports found.<b></td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
