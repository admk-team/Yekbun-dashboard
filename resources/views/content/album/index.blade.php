
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
                  <a href="{{ route('album.index') }}">
                      <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='menu-icon tf-icons bx bxs-user bx-md'></i>Add Album</button>
                  </a>
              </li>
              <li class="nav-item" role="presentation">
                  <a href="{{ route('artist.index') }}">
                      <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='bx bx-plus-circle bx-md'></i>Add Artist</button>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>
<div class="d-flex justify-content-center mt-2 mb-2">
  <button class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#createalbumModal">Add Album</button>
</div>

   <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Table Basic</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Artist</th>
            <th>Image </th>
            <th>Status </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($album as $albums)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $albums->artist->name ?? '' }} 
            </td>
            <td><img src="{{ asset('storage/'.$albums->image) }}"  width="70" height="70"></td>

            <td>
              <?php
                 $json = $albums->album;
                 $arr = json_decode($json, true); 
              ?>
              <audio controls>
              <source src="{{ asset('storage/'.$arr[0]) }}">
              </audio>
            </td>
            <td>
               @if($albums->status == '0')
               <button class="btn btn-danger">UnPublish</button>
               @else
               <button class="btn btn-success">Publish</button>
               @endif
              </td>
            <td>
                <div class="dropdown d-inline-block">
                  <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown"
                    class="mb-2 mr-2 dropdown-toggle btn btn-light">Action
                  </button>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" style="min-width: 9rem;">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#editalbumModal{{ $albums->id }}">Edit</button>
                      </li>
                      <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                          data-id="{{ route('album.destroy',$albums->id) }}">
                          <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <x-modal id="editalbumModal{{ $albums->id }}" 
                title="Edit Album"
                 saveBtnText="Update" 
                 saveBtnType="submit"
                  saveBtnForm="editForm{{ $albums->id }}" 
                  size="xl">

                  @include('content.include.album.editForm')
                </x-modal>
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

{{-- Create Music model --}}
<x-modal 
id="createalbumModal" 
title="Create Album"
 saveBtnText="Create" 
 saveBtnType="submit"
  saveBtnForm="createForm" 
  size="xl">
    
 @include('content.include.album.createForm')
</x-modal>
@endsection
