@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="contianer">
  <div class="row">
      <div class="col-xl-12">
          <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                      <a href="{{ route('series.series.index') }}">
                          <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='bx bx-plus-circle bx-lg'></i>Manage Series</button>
                      </a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a href="{{ route('series.series.categories.index') }}">
                          <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='bx bx-plus-circle bx-lg'></i>Add Categroy</button>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <div class="d-flex justify-content-center mt-2 mb-2">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createseriesModal">Add Series</button>
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
            <th>Movie</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($series as $serie)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img src="{{ asset('storage/'.$serie->thumbnail) }}" width="100" height="100"></td>
            <td>{{ $serie->title ?? '' }}</td>
            <td>{{ $serie->series_category->name  ?? '' }}</td>
            <td>
              @php
                $json = $serie->series;
                $arr = json_decode($json, true);
              @endphp
              <video controls width="150" preload="none">
              <source src="{{ asset('storage/'.$arr[0]) }}" type="video/mp4">
            </video></td>
            <td>
              <div class="dropdown d-inline-block show">
                @php
                if($serie->status==1){
                $btn='success';
                }else{
                $btn='danger';
                }
                @endphp
                <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown"
                  class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
                  @if ($serie->status==1)
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
                      <a href="{{ route('movies_status',['id'=>$serie->id,'status'=>1]) }}"
                        class="nav-link">Active
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('movies_status',['id'=>$serie->id,'status'=>0]) }}"
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
                      <button class="btn" data-bs-toggle="modal" data-bs-target="#editmoviesModal{{ $serie->id }}">Edit</button>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);"
                        data-id="{{ route('series.series.destroy',$serie->id) }}">
                        <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <x-modal id="editmoviesModal{{$serie->id}}" title="Update Movie" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{$serie->id}}" size="xl">
                @include('content.include.series.editForm')
              
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
<x-modal id="createseriesModal" title="Create Series" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="xl">
  @include('content.include.series.createForm')

</x-modal>
@endsection
