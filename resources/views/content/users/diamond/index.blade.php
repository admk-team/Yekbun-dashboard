@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Users /</span> List of Diamond Users
    </h4>
  </div>
  <div class="">
      <a href="{{ route('users.diamond.create') }}">
        <button class="btn btn-primary">Add User</button>
      </a>
  </div>
</div>
  
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Diamond Users List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Joined</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($users as $user)
          <tr>
            <td>
              <img style="width: 50px; height: 60px;" src="{{$user->image? url('storage/' . $user->image): 'https://www.w3schools.com/howto/img_avatar.png' }}">
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('F jS, Y') }}</td>
            <td>
              @if ($user->status)
                <span class="badge bg-label-primary me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Disabled</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('users.diamond.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <form action="{{ route('users.diamond.destroy', $user->id) }}" method="post">
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
            <td class="text-center" colspan="5"><b>No users found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection
