@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')

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

<div class="d-flex justify-content-between">
    <div>
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Video /</span> All Video
        </h4>
    </div>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createvideoModal">Add Video</button>
    </div>
</div>


<div class="row" style="background:#fff; border-radius:14px; padding:5px;">
    <div class="col-md-12">
        <div class=" d-flex justify-content-end">
            <div id="DataTables_Table_0_filter" class="">
            <input type="search" class="form-control col-md-3" placeholder="Search" aria-controls="DataTables_Table_0">
        </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-3">
                <div class="card mt-3">
                    <div class="card-body p-0 border-none">
                        <div class="list-group" role="tablist">
                            <a class="list-group-item list-group-item-action" href="?show=all">
                                <i class='bx bxs-shopping-bags'></i> All Uploaded Video<br>
                                <small class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All user video here</small>
                            </a>
                            <a class="list-group-item list-group-item-action" href="?show=fanpage">
                                <i class='bx bxs-shopping-bags'></i> All Live Stream<br>
                                <small class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All Fan Feed here</small>
                            </a>
                            <a class="list-group-item list-group-item-action" href="?show=reported">
                                <i class='bx bxs-shopping-bags'></i> Reported Videos<br>
                                <small class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Report</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @if(count($upload_video))
        @foreach($upload_video as $video)
        <div class="col-md-4">
            @php
            $json = $video->video;
            $arr = json_decode($json, true);
            @endphp
            <video controls width="460px" style="border-radius:13px;" class="mt-3">
                <source src="{{ asset('storage/'.$arr[0]) }}" />
            </video>
            <div class="image d-flex gap-2" style="position: relative;">
                <img src="{{ asset('assets/img/avatars/20.png') }}" width="50" height="50" style="border-radius: 50%">
                <div>
                    <p class="m-0">{{ $video->title ?? '' }}</p>
                    <p>{{ $video->videocategory->category ?? '' }}</p>
                </div>
                <div class="dropup d-none d-sm-block" style="position: absolute; right:0;">
                    <button class="btn p-0" type="button" id="sharedList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList" style="">
                        <form action="{{ route('upload-video.destroy', $video->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Remove Feed<br>
                                <small class="text-muted">Feed removed only</small>
                            </button>
                        </form>

                        <form action="{{ $video->user_id ? route('upload-video.destroyAndFlagUser', ['id' => $video->id, 'user_id' => $video->user_id]): '' }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="{{ $video->user_id? 'submit': 'button' }}" class="dropdown-item">
                                Remove - Flag User<br>
                                <small class="text-muted">Remove Feed - Flag User</small>
                            </button>
                        </form>

                        <form action="{{ $video->user_id ? route('upload-video.destroyAndBlockUser', ['id' => $video->id, 'user_id' => $video->user_id]): '' }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="{{ $video->user_id? 'submit': 'button' }}" class="dropdown-item">
                                Remove Block<br>
                                <small class="text-muted">Remove Feed - Block User</small>
                            </button>
                        </form>

                        <form action="{{ $video->user_id? route('upload-video.destroyAndRemoveUser', $video->user_id): '' }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="{{ $video->user_id? 'submit': 'button' }}" class="dropdown-item">
                                Remove User<br>
                                <small class="text-muted">Remove Account - IMEI</small>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        @else
    <strong class="text-center"> {{ isset($msg) ? $msg : '' }} </strong>
  @endif
    </div>
  
    </div>
</div>
<!-- Basic Bootstrap Table -->
{{-- <div class="card">
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
<td><img src="{{ asset('storage/'.$video->thumbnail) }}" width="100" height="100"></td>
<td>{{ $video->title ?? '' }}</td>
<td>{{ $video->videocategory->category ?? '' }}</td>
<td> @php
    $json = $video->video;
    $arr = json_decode($json, true);
    @endphp<video controls width="150">
        <source src="{{ asset('storage/'.$arr[0]) }}" type="video/mp4">
    </video> </td>
<td>
    <div class="dropdown d-inline-block show">
        @php
        if($video->status==1){
        $btn='success';
        }else{
        $btn='danger';
        }
        @endphp
        <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
            @if ($video->status==1)
            Active
            @else
            Dective
            @endif
        </button>
        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -362px, 0px); top: 0px; left: 0px; will-change: transform;min-width: 9rem;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('video_status',['id'=>$video->id,'status'=>1]) }}" class="nav-link">Active
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('video_status',['id'=>$video->id,'status'=>0]) }}" class="nav-link">Deactive</a>
                </li>
            </ul>
        </div>
    </div>
</td>
<td>
    <div class="dropdown d-inline-block">
        <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-light">Action
        </button>
        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" style="min-width: 9rem;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#editvideoModal{{ $video->id }}">Edit</button>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);" data-id="{{ route('upload-video.destroy',$video->id) }}">
                        <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <x-modal id="editvideoModal{{ $video->id }}" title="Edit Video" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{ $video->id }}" size="xl">
        @include('content.include.videos.editForm')
    </x-modal>

</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div> --}}
<!--/ Basic Bootstrap Table -->
<div class="modal fade deleted-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px;" aria-modal="true">
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
    function delete_service(el) {
        let link = $(el).data('id');
        $('.deleted-modal').modal('show');
        $('#delete_form').attr('action', link);
    }

</script>
<x-modal id="createvideoModal" title="Create Video" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="md">
    @include('content.include.videos.createFile')
</x-modal>

@endsection
