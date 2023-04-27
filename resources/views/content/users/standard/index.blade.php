@extends('layouts/layoutMaster')

@section('title', 'Users - Standard')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Users /</span> List of Standard Users
    </h4>
  </div>
  <div class="">
      <!-- <a href="{{ route('users.standard.create') }}">
        <button class="btn btn-primary">Add User</button>
      </a> -->
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add User</button>
  </div>
</div>

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Session</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">21,459</h4>
              <small class="text-success">(+29%)</small>
            </div>
            <small>Total Users</small>
          </div>
          <span class="badge bg-label-primary rounded p-2">
            <i class="bx bx-user bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Paid Users</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">4,567</h4>
              <small class="text-success">(+18%)</small>
            </div>
            <small>Last week analytics </small>
          </div>
          <span class="badge bg-label-danger rounded p-2">
            <i class="bx bx-user-plus bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Active Users</span>
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
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Pending Users</span>
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
    <h5 class="card-header">Standard Users List</h5>
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
                  <!-- <a class="dropdown-item" href="{{ route('users.standard.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                  <form action="{{ route('users.standard.destroy', $user->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>
              <x-modal
                id="editModal{{ $user->id }}"
                title="Edit Standard User" 
                saveBtnText="Update"
                saveBtnType="submit"
                saveBtnForm="editForm{{ $user->id }}"
                size="xl"
                :show="old('showEditFormModal'.$user->id)? true: false"
              >
                @include('content.users.standard.includes.edit_form')
              </x-modal>
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

  <x-modal
    id="createModal"
    title="Add Standard User" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    size="xl"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.users.standard.includes.create_form')
  </x-modal>
@endsection
