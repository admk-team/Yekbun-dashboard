@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="contianer">

  {{-- <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="#"><i class='bx bx-plus-circle bx-lg'></i>Add Video</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('upload-video-category.index') }}"><i class='bx bx-plus-circle bx-lg' ></i>Add Category</a>
    </li>
  </ul> --}}
  <ul class="nav nav-tabs">
    <li class="active"><a href="{{ route('upload-video.index') }}"><i class='bx bx-plus-circle bx-lg'></i>Manage Video</a></li>
    <li><a href="{{ route('upload-video-category.index') }}"><i class='bx bx-plus-circle bx-lg' ></i>Add Categroy</a></li>
  </ul>
  <div>
</div>
<div class="d-flex justify-content-center mt-2 mb-2">
    <a href="{{ route('upload-video.create') }}">
<button class="btn btn-primary">Add Video </button> 
    </a>
</div>
</div>

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Videos</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">21,459</h4>
              <small class="text-success">(+29%)</small>
            </div>
            <small>Last week analytics</small>
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
            <span>Uploaded Videos</span>
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
            <span>Total Movies</span>
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
            <span>Video Size Total</span>
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
    <h5 class="card-header">Table Basic</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Category</th>
            <th>video</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($upload_video as $video)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $video->thumbnail ?? '' }}</td>
            <td>{{ $video->title ?? '' }}</td>
            <td>{{ $video->videocategory->category ?? '' }}</td>
            <td><video controls width="150">
              <source src="{{ asset('storage/'.$video->video) }}" type="video/mp4">
            </video></td>
            <td>
              <div class="dropdown d-inline-block show">
                @php
                if($video->status==1){
                $btn='success';
                }else{
                $btn='danger';
                }
                @endphp
                <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown"
                  class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
                  @if ($video->status==1)
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
                      <a href="{{ route('video_status',['id'=>$video->id,'status'=>1]) }}"
                        class="nav-link">Active
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('video_status',['id'=>$video->id,'status'=>0]) }}"
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
                      <a href="{{ route('upload-video.edit',$video->id) }}" class="nav-link">
                        <i class="nav-link-icon pe-7s-chat"> </i><span>Edit</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                        data-id="{{ route('upload-video.destroy',$video->id) }}">
                        <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                      </a>
                    </li>
                  </ul>
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
