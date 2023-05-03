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
            <span>Total Music</span>
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
            <span>Total Artist</span>
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
            <span>Total Album</span>
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
            <span>Total Size</span>
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


{{-- Nav TAb --}}
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Music /</span> All Music
</h4>
</div>
<div class="">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createmusicModal">Add Music</button>
</div>
</div>

   <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Music List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Music Name</th>
            <th>Category</th>
            <th>Track</th>
            <th>Status </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if(count($music))
            @foreach($music as $musics)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $musics->music_category->name ?? '' }} 
            </td>
            <td>
              <?php
                 $json = $musics->audio;
                 $arr = json_decode($json, true); 
              ?>
              <audio controls>
              <source src="{{ asset('storage/'.$arr[0]) }}">
              </audio>
            </td>
            <td>
               @if($musics->status == '0')
               <span class="badge bg-label-secondary">UnPublish</span>
               @else
             <span class="badge bg-label-success">Publish</span>
               @endif
              </td>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                  <button class="btn" data-bs-toggle="modal" data-bs-target="#editmusicModal{{ $musics->id }}"><i class="bx bx-edit"></i></button>
                <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"data-id="{{ route('music.destroy',$musics->id) }}">
                          <i class="bx bx-trash"></i></a>
                <x-modal id="editmusicModal{{ $musics->id }}" 
                title="Edit Music"
                 saveBtnText="Update" 
                 saveBtnType="submit"
                  saveBtnForm="editForm{{ $musics->id }}" 
                  size="md">

                  @include('content.include.music.editForm')
                </x-modal>
              </div>
              </td>
          </tr>
          {{-- @empty --}}
         
          @endforeach
          @else
          <tr>
            <td class="text-center" colspan="8"><b>No Music found.<b></td>
          </tr>
          @endif
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
id="createmusicModal" 
title="Create Music"
 saveBtnText="Create" 
 saveBtnType="submit"
  saveBtnForm="createForm" 
  size="md">
    
 @include('content.include.music.createForm')
</x-modal>
@endsection
