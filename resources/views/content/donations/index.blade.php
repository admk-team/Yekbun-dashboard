@extends('layouts/layoutMaster')

@section('title', 'Donations - List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Donations /</span> All Donations
</h4>
</div>
<div class="">
    <a href="{{ route('donations.create') }}">
      <button class="btn btn-primary">Add Donation</button>
    </a>
</div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Donation List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Organization</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($donations as $donation)
          <tr>
            <td>{{ $donation->title }}</td>
            <td>
              @if ($donation->organization)
                <a href="{{ route('donations.organizations.edit', $donation->organization->id) }}" target="_blank">{{ $donation->organization->name }}</a>
              @endif
            </td>
            <td>{{ $donation->start_date->format('F jS, Y') }}</td>
            <td>{{ $donation->end_date->format('F jS, Y') }}</td>
            <td>{{ $donation->created_at->format('F jS, Y') }}</td>
            <td>
              @if ($donation->status)
                <span class="badge bg-label-primary me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Disabled</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('donations.edit', $donation->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <form action="{{ route('donations.destroy', $donation->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No donations found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection
