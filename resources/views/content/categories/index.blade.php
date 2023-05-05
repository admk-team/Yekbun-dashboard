@extends('layouts/layoutMaster')

@section('title', ucfirst(($target?? '')) . ' - Categories List')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ ucfirst(($target?? '')) }} /</span> Categories
</h4>
</div>
<div class="">
    
</div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">{{ ucfirst(($target?? '')) }} Categories List</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add Category</button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($categories as $category)
          <tr>
            <td>{{ $category->name }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                  <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                  </form>
                </div>
              </div>
              <x-modal
                id="editModal{{ $category->id }}"
                title="Edit Category" 
                saveBtnText="Update"
                saveBtnType="submit"
                saveBtnForm="editForm{{ $category->id }}"
                size="sm"
                :show="old('showEditFormModal'.$category->id)? true: false"
              >
                @include('content.categories.includes.edit_form')
              </x-modal>
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No categories found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <x-modal
    id="createModal"
    title="Add Category" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    size="sm"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.categories.includes.create_form')
  </x-modal>
@endsection
