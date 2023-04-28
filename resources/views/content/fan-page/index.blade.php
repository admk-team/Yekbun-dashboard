@extends('layouts/layoutMaster')

@section('title', 'Fanpage - Manage')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Fan Page /</span> Manage
</h4>
</div>
<!-- <div class="">
    <a href="{{ route('fanpage.create') }}">
    <button class="btn btn-primary">Add FanPage</button>
  </a>
</div> -->
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Fan Pages</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Username</th>
            <th>FanPage Name</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($fanpage as $page)
          <tr>
            <td>{{ $page->id }}</td>
            <th></th>
            <td>{{ $page->user_name ?? '' }}</td>
            <td>{{ $page->fanpage_name ?? '' }}</td>
            <td>
              @if ($page->status === 0)
                <span class="badge bg-label-primary me-1">Pending</span>
              @elseif ($page->status === 1)
                <span class="badge bg-label-success me-1">Accepted</span>
              @elseif ($page->status === 2)
                <span class="badge bg-label-warning me-1">Rejected</span>
              @else
                <span class="badge bg-label-danger me-1">Blocked</span>
              @endif
            </td>
            <td>
              <a href="{{ route('fanpage-status', ['id' => $page->id, 'status' => 1]) }}" class="btn badge badge-center bg-label-secondary ms-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Accept"><i class="bx bx-check"></i></a>
              <button class="btn badge badge-center bg-label-danger ms-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Block" onclick="$('#warningModal{{ $page->id }}').modal('show')"><i class="bx bx-block"></i></button>
              <x-modal
                title="Block Page"
                id="warningModal{{ $page->id }}"
                onSaveBtnClick="window.location.href = '{{ route('fanpage-status', ['id' => $page->id, 'status' => 3]) }}'"
                saveBtnText="Block"
                saveBtnClass="btn btn-danger"
                closeBtnText="Cancel"
              >
                Are you sure want to block this page?
              </x-modal>
              <!-- <div class="dropdown d-inline-block">
                <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown"
                  class="mb-2 mr-2 dropdown-toggle btn btn-light">Action
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" style="min-width: 9rem;">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a href="{{ route('fanpage.edit',$page->id) }}" class="nav-link">
                        <i class="nav-link-icon pe-7s-chat"> </i><span>Edit</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                        data-id="{{ route('fanpage.destroy',$page->id) }}">
                        <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div> -->
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

  <div class="modal fade deleted-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  style="padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Fan page</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-0">Are you Sure to delete this!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="post" id="delete_form">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function delete_service(el){
    let link=$(el).data('id');
    $('.deleted-modal').modal('show');
    $('#delete_form').attr('action', link);
  }
</script>
@endsection
