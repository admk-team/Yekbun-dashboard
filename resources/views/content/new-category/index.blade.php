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
                    <a href="{{ route('news.index') }}">
                        <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='menu-icon tf-icons bx bxs-user bx-md'></i>Add News</button>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('news-category.index') }}">
                        <button type="button" class="nav-link active" role="tab" aria-selected="true"><i class='bx bx-plus-circle bx-md'></i>Add Categroy</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-2 mb-2">
    <button class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#createnewscategoryModal">Add News Category</button>
</div>>

<!-- Category Model -->
<div class="modal fade" id="createnewscategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{ route('news-category.store') }}">
                        @csrf
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">Name</label>
                            <input type="text" id="nameLarge" class="form-control" placeholder="Enter Name" name="news_category">
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
                @foreach($news_category as $news)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $news->name ?? '' }}</td>
                    <td>
                        <div class="dropdown d-inline-block show">
                            @php
                            if($news->status==1){
                            $btn='success';
                            }else{
                            $btn='danger';
                            }
                            @endphp
                            <button type="button" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-{{ $btn }}">
                                @if ($news->status==1)
                                Active
                                @else
                                Dective
                                @endif
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -362px, 0px); top: 0px; left: 0px; will-change: transform;min-width: 9rem;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('newscat-status',['id'=>$news->id,'status'=>1]) }}" class="nav-link">Active
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('newscat-status',['id'=>$news->id,'status'=>0]) }}" class="nav-link">Deactive</a>
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
                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#editnewscategoryModal{{ $news->id }}">edit</button>

                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link" type="button" onclick="delete_service(this);" data-id="{{ route('news-category.destroy',$news->id) }}">
                                            <i class="nav-link-icon pe-7s-wallet"> </i><span>Delete</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Category Model -->
                        <div class="modal fade" id="editnewscategoryModal{{ $news->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form method="POST" action="{{ route('news-category.update',$news->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="row">
                                                    <div class="col-lg-8 mx-auto">
                                                        <!-- 1. Delivery Address -->
                                                        <h5 class="mb-4">Category Name</h5>
                                                        <div class="row g-3">
                                                            <div class="col-md-12">

                                                                <label class="form-label" for="fullname">News Category</label>
                                                                <input type="text" id="fullname" class="form-control" placeholder="Jang" name="news_category" value="{{ $news->name ?? '' }}">
                                                                @error('news_category')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
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
@endsection
