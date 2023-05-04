@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')


{{-- Nav TAb --}}
<div class="d-flex justify-content-between">
    <div>
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Artist /</span> All Artist
        </h4>
    </div>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createartistModal">Add Artist</button>
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Artist List</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Artist Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if(count($artist))
                @foreach($artist as $artists)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/'.$artists->image) }}" style="height:100px; width:auto"></td>
                    <td>{{ $artists->first_name ?? '' }}</td>
                    <td>{{ $artists->last_name ?? '' }}</td>
                    {{-- <td>
                        <div class="dropdown d-inline-block show">
                            @php
                            if($artists->status==1){
                            $btn='success';
                            }else{
                            $btn='danger';
                            }
                            @endphp
                            <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
                    @if ($artists->status==1)
                    Active
                    @else
                    Dective
                    @endif
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -362px, 0px); top: 0px; left: 0px; will-change: transform;min-width: 9rem;">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('artists-status',['id'=>$artists->id,'status'=>1]) }}" class="nav-link">Active
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('artists-status',['id'=>$artists->id,'status'=>0]) }}" class="nav-link">Deactive</a>
                            </li>
                        </ul>
                    </div>
    </div>
    </td> --}}

    <td>
        <div class="d-flex justify-content-start align-items-center">
         <span data-bs-toggle="modal" data-bs-target="#editartistModal{{ $artists->id }}">
            <button class="btn" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit"><i class="bx bx-edit"></i></button></span>
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove" class="nav-link" type="button" onclick="delete_service(this);" data-id="{{ route('artist.destroy',$artists->id) }}">
                <i class="bx bx-trash"></i></a>
            <x-modal id="editartistModal{{ $artists->id }}" title="Edit Artist" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{ $artists->id }}" size="md">
                @include('content.include.artist.editForm')
            </x-modal>
        </div>
    </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="text-center" colspan="8">No Artist found.</td>
    </tr>
    @endif


    </tbody>
    </table>
</div>
</div>
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
<x-modal id="createartistModal" title="Create Artist" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="md">
    @include('content.include.artist.createForm')
</x-modal>
@endsection
