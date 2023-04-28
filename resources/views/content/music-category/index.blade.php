@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
{{-- Nav TAb --}}
<div class="row">
  <div class="col-xl-12">
      <div class="nav-align-top mb-4">
          <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                  <a href="{{ route('music.index') }}">
                      <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='menu-icon tf-icons bx bxs-user bx-md'></i>Manage Items</button>
                  </a>
              </li>
              <li class="nav-item" role="presentation">
                  <a href="{{ route('music-category.index') }}">
                      <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='bx bx-plus-circle bx-md'></i>Add Categroy</button>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>
<div class="d-flex justify-content-center mt-2 mb-2">
  <button class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#createmusiccategoryModal">Add Category</button>
</div>

  <!-- Category Model -->
  <div class="modal fade" id="createmusiccategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="POST" action="{{ route('music-category.store') }}">
                @csrf
            <div class="col mb-3">
              <label for="nameLarge" class="form-label">Name</label>
              <input type="text" id="nameLarge" class="form-control" placeholder="Enter Name" name="music_category">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>



  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Table Basic</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($music_category as $music)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $music->name ?? '' }}</td>
            <td>
                <div class="dropdown d-inline-block show">
                  @php
                  if($music->status==1){
                  $btn='success';
                  }else{
                  $btn='danger';
                  }
                  @endphp
                  <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown"
                    class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
                    @if ($music->status==1)
                    Active
                    @else
                    Dective
                    @endif
                  </button>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu"
                    x-placement="top-start"
                    style="position: absolute; transform: translate3d(0px, -362px, 0px); top: 0px; left: 0px; will-change: transform;min-width: 9rem;">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a href="{{ route('musiccat-status',['id'=>$music->id,'status'=>1]) }}"
                          class="nav-link">Active
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('musiccat-status',['id'=>$music->id,'status'=>0]) }}"
                          class="nav-link">Deactive</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </td>

            <td>
                <div class="dropdown d-inline-block">
                  <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown"
                    class="mb-2 mr-2 dropdown-toggle btn btn-light">Action
                  </button>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" style="min-width: 9rem;">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                          <button class="btn" data-bs-toggle="modal" data-bs-target="#editmusiccategoryModal{{ $music->id }}">Edit</button>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                          data-id="{{ route('music-category.destroy',$music->id) }}">
                          <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                 {{-- Edit Category Music Model --}}
                 <div class="modal fade" id="editmusiccategoryModal{{ $music->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel3"> Edit Category</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <form method="POST" action="{{ route('music-category.update',$music->id) }}">
                                      @csrf
                                      @method('put')
                                      <div class="col mb-3">
                                          <label for="nameLarge" class="form-label">Name</label>
                                          <input type="text" id="nameLarge" class="form-control" placeholder="Enter Name" name="music_category" value={{ $music->name ?? '' }}>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                  </form>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>

              </td>
          </tr>
          @endforeach
       
      
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Banner</h5>
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
