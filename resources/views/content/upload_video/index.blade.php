@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Video Clip /</span> All Video Clip
</h4>
</div>
<div class="">
    <a href="{{ route('upload_video.create') }}">
<button class="btn btn-primary">Add Video Clip</button>
</a>
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
            <th>Title</th>
            <th>Artist</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($upload_video as $video)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $video->title ?? '' }}</td>
            <td>
              {{ $video->artist->first_name ?? '' }}
            </td>
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
                      <a href="{{ route('upload-status',['id'=>$video->id,'status'=>1]) }}"
                        class="nav-link">Active
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('upload-status',['id'=>$video->id,'status'=>0]) }}"
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
                      <a href="{{ route('upload_video.edit',$video->id) }}" class="nav-link">
                        <i class="nav-link-icon pe-7s-chat"> </i><span>Edit</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                        data-id="{{ route('upload_video.destroy',$video->id) }}">
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
@endsection
