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
            <span class="text-muted fw-light">Album /</span> All Album
        </h4>
    </div>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createalbumModal">Add Album</button>
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Album List</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Artist</th>
                    <th>Album Title </th>
                    <th>Total Album </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if(count($album))
                @foreach($album as $albums)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $albums->artist->first_name  ?? '' }}
                    </td>
                    <td>{{ $albums->title ?? '' }}</td>
                    <td><?php  $count = DB::table('albums')->where('artist_id' , $albums->artist->id)->count(); ?> {{ $count ?? '' }}</td>
                    <?php
                 $json = $albums->album;
                 $arr = json_decode($json, true); 
              ?>
                    <td>
                        <div class="d-flex justify-content-start align-items-center">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#editalbumModal{{ $albums->id }}"><i class="bx bx-edit"></i></button>
                            <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);" data-id="{{ route('album.destroy',$albums->id) }}">
                                <i class="bx bx-trash"></i></a>
                            <x-modal id="editalbumModal{{ $albums->id }}" title="Edit Album" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{ $albums->id }}" size="md">

                                @include('content.include.album.editForm')
                            </x-modal>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td class="text-center" colspan="8">No Album found.</td>
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

{{-- Create Music model --}}
<x-modal id="createalbumModal" title="Create Album" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="md">

    @include('content.include.album.createForm')
</x-modal>
@endsection
