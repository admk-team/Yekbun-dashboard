@extends('layouts/layoutMaster')

@section('title', 'Posts - List')
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />

@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>

<style>
    .comment-box {
        max-height: 500px;
    }

    .btn-reply {
        border: 0 !important;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }

    .btn-reply:hover {
        color: #696cff !important;
    }

</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
<script>
    const dropZoneInitFunctions = [];
  </script>
<div class="d-flex justify-content-between">
    <div>
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Posts /</span> All Posts
        </h4>
    </div>
    <div class="">
        {{-- <a href="{{ route('posts.create') }}">
        <button class="btn btn-primary">Add Post</button>
        </a>--}}
        {{-- @can('posts.create')
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Post</button>
    @endcan --}}
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Posts</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $totalPosts }}</h4>
                            <small class="text-success">(+29%)</small>
                        </div>
                        <small>Total Posts</small>
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
                        <span>User Post Total</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $totalUserPosts }}</h4>
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
                        <span>Admin Post Total</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $totalAdminPosts }}</h4>
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
                        <span>Removed Total</span>
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


<div class="row">
    <div class="d-none d-md-block col-md-3">
        <div class="card">
            <div class="card-body p-0 border-none">
                <div class="list-group nav nav-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" href="?show=all">
                        All Feeds<br>
                        <small class="text-muted">All User Feeds here</small>
                    </a>
                    <a class="list-group-item list-group-item-action" href="?show=fanpage">
                        Fanpage Feeds<br>
                        <small class="text-muted">All Fan Feeds here</small>
                    </a>
                    <a class="list-group-item list-group-item-action" href="?show=reported">
                        Reported Feeds<br>
                        <small class="text-muted">All reported Feeds</small>
                    </a>
                    <a class="list-group-item list-group-item-action" href="?show=admin">
                        Admin Feeds<br>
                        <small class="text-muted">All Admin Feeds</small>
                    </a>
                    <a class="list-group-item list-group-item-action" href="?show=background">
                        Post Background<br>
                        <small class="text-muted">All Post Background</small>
                    </a>
                    <a class="list-group-item list-group-item-action" href="?show=animated">
                        Animated Emoji<br>
                        <small class="text-muted">All Animated Emoji</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 {{ $show == "background" || $show == "animated" ? "col-md-9" : "col-md-6" }} ">
        {{-- @if($show != "background" || $show != "animated") --}}
        @forelse($posts as $post)
        @php
        $reportedComments = $post->comments()->whereExists(function ($query) {
        $query->select(DB::raw(1))
        ->from('reports')
        ->whereColumn('reports.reported_comment_id', 'comments.id')
        ->where('status', 0);
        })->get()
        @endphp
        <!-- Start: Post -->
        <div x-data="{ showComments:false, showReportedComments: false }">
            <div class="card h-100 mb-4">
                <div x-show="!showComments && !showReportedComments">
                    <div class="card-header flex-grow-0">
                        <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('storage/' . ($post->users && $post->users->image? $post->users->image: '../assets/img/avatars/20.png'))  }}" alt="User" class="rounded-circle">
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                <div class="me-2">
                                    <h5 class="mb-0">{{ $post->users? $post->users->name: 'Admin' }}</h5>
                                    <small class="text-muted">{{ $post->created_at->format('d M Y') }} at {{ $post->created_at->format('h:i A') }}</small>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    @if ($post->reports()->where('status', 0)->get()->count() > 0)
                                    <i class='bx bxs-flag-alt text-danger me-4'></i>
                                    @endif
                                    @if ($reportedComments->count() > 0)
                                    <button @click="showReportedComments = !showReportedComments" class="btn me-3 btn-danger btn-xs">Reported Comments ({{ $reportedComments->count() }})</button>
                                    @endif
                                    <div class="dropup d-none d-sm-block">
                                        <button class="btn p-0" type="button" id="sharedList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList" style="">
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="confirmAction(event, () => event.target.submit())">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true">
                                                    Remove Feed<br>
                                                    <small class="text-muted">Feed removed only</small>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ $post->users? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->users->id]): '' }}" method="post" {!! $post->users? 'onsubmit="confirmActionFlag(event, () => event.target.submit())"': '' !!}>
                                                @method('DELETE')
                                                @csrf
                                                <button type="{{ $post->users? 'submit': 'button' }}" {!! $post->users? '': 'onclick="confirmActionFlag(event, () => event.target.click())"' !!} class="dropdown-item" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true">
                                                    Remove - Flag User<br>
                                                    <small class="text-muted">Remove Feed - Flag User</small>
                                                </button>
                                            </form>
                                            <form action="{{ $post->users? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->users->id]): '' }}" method="post" {!! $post->users? 'onsubmit="confirmActionBlock(event, () => event.target.submit())"': '' !!}>
                                                @method('DELETE')
                                                @csrf
                                                <button type="{{ $post->users? 'submit': 'button' }}"  {!! $post->users? '': 'onclick="confirmActionBlock(event, () => event.target.click())"' !!} class="dropdown-item" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true">
                                                    Remove Block<br>
                                                    <small class="text-muted">Remove Feed - Block User</small>
                                                </button>
                                            </form>
                                            <form action="{{ $post->users? route('posts.destroyAndRemoveUser', $post->users->id): '' }}" method="post" {!! $post->users? 'onsubmit="confirmActionAccount(event,() => event.target.submit())"':'' !!}>
                                                @method('DELETE')
                                                @csrf
                                                <button type="{{ $post->users? 'submit': 'button' }}"{!! $post->users? '' : 'onclick="confirmActionAccount(event,() => event.target.click())"' !!} class="dropdown-item" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true">
                                                    Remove User<br>
                                                    <small class="text-muted">Remove Account - IMEI</small>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($post->description)
                    <div class="post-text px-4 mb-2">{{ $post->description }}</div>
                    @endif
                    <div class="post-media position-relative">
                        @if ($post->media)
                        <div class="image-wrap overflow-hidden d-flex align-items-center" style="height: 360px;">
                            @php
                                $convertedJson = json_decode($post->media);
                            @endphp
                            <img class="w-100" src="{{$convertedJson[0]->path}}" alt="Card image cap">
                        </div>
                        @endif
                        <div class="post-actions card-actions d-flex align-items-center position-absolute gap-2" style="right:16px; bottom: -21px;">
                            <button @click="showComments = ! showComments" type="button" class="btn rounded-pill btn-icon btn-label-primary btn-lg shadow">
                                <span class="tf-icons bx bx-message"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-label-warning btn-lg shadow">
                                <span class="tf-icons bx bx-share"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-label-danger btn-lg shadow">
                                <span class="tf-icons bx bx-heart"></span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-end">
                            {{-- <ul class="list-unstyled m-0 d-flex align-items-center avatar-group">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                    <img class="rounded-circle" src="http://127.0.0.1:8080/assets/img/avatars/5.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                                    <img class="rounded-circle" src="http://127.0.0.1:8080/assets/img/avatars/12.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                                    <img class="rounded-circle" src="http://127.0.0.1:8080/assets/img/avatars/6.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Darcey Nooner" data-bs-original-title="Darcey Nooner">
                                    <img class="rounded-circle" src="http://127.0.0.1:8080/assets/img/avatars/10.png" alt="Avatar">
                                </li>
                            </ul> --}}
                            <div class="card-actions d-flex align-items-center">
                                <a href="javascript:;" class="text-muted me-3"><i class="bx bx-heart me-1"></i> 236</a>
                                <a @click="showComments = ! showComments" href="javascript:;" class="text-muted me-3"><i class="bx bx-message me-1"></i> 12</a>
                                <a href="javascript:;" class="text-muted"><i class="bx bx-share me-1"></i> 5</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="showComments">
                    <div class="card-header flex-grow-0 border-bottom">
                        <div class="d-flex">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                <div class="me-2">
                                    <h5 class="mb-0">Comments ({{ $post->comments->count() }})</h5>
                                </div>
                                <div class="dropup d-none d-sm-block">
                                    <button class="btn p-0" type="button" @click="showComments = false">
                                        <i class="tf-icons bx bx-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body comment-box py-3" style="overflow: hidden; overflow-y:auto;">
                        @forelse($post->comments()->where('parent_id', null)->get() as $comment)
                        <div class="comment {{ !$loop->last? 'border-bottom mb-3': '' }}">
                            <div class="d-flex">
                                <div>
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('storage/' . ($comment->user && $comment->user->image? $comment->user->image: '../assets/img/avatars/20.png'))  }}" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="pb-2 {{ $comment->subComments->count() > 0? 'border-bottom mb-3': '' }}">
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 text-dark">{{ $comment->user? $comment->user->name: '' }}</p>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                @if ($comment->reports()->where('status', 0)->get()->count() > 0)
                                                <i class='bx bxs-flag-alt text-danger me-4'></i>
                                                @endif
                                                <div class="dropdown d-none d-sm-block">
                                                    <button class="btn p-0" type="button" id="sharedList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList" style="">
                                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                Remove Comment<br>
                                                                <small class="text-muted">Comment removed only</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove - Flag User<br>
                                                                <small class="text-muted">Remove Comment - Flag User</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove Block<br>
                                                                <small class="text-muted">Remove Comment - Block User</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndRemoveUser', $post->user->id): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove User<br>
                                                                <small class="text-muted">Remove Account - IMEI</small>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content mb-2">
                                            {{ $comment->content }}
                                        </div>
                                        <div class="actions d-flex align-items-center gap-2">
                                            <button type="button" class="btn rounded-pill btn-icon btn-label-primary btn-sm">
                                                <span class="tf-icons bx bx-like"></span>
                                            </button>
                                            <button type="button" class="btn p-0 btn-reply">Reply</button>
                                        </div>
                                    </div>
                                    <div class="sub-comments">
                                        @foreach($comment->subComments as $subComment)
                                        <div class="sub-comment {{ !$loop->last? 'border-bottom pb-2 mb-3': '' }}">
                                            <div class="d-flex">
                                                <div>
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="{{ asset('storage/' . ($subComment->user && $subComment->user->image? $subComment->user->image: '../assets/img/avatars/20.png'))  }}" class="rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <p class="mb-0 text-dark">{{ $subComment->user? $subComment->user->name: '' }}</p>
                                                            <small class="text-muted">{{ $subComment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            @if ($subComment->reports()->where('status', 0)->get()->count() > 0)
                                                            <i class='bx bxs-flag-alt text-danger me-4'></i>
                                                            @endif
                                                            <div class="dropdown d-none d-sm-block">
                                                                <button class="btn p-0" type="button" id="sharedList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList" style="">
                                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">
                                                                            Remove Comment<br>
                                                                            <small class="text-muted">Comment removed only</small>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ $post->user? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                            Remove - Flag User<br>
                                                                            <small class="text-muted">Remove Comment - Flag User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ $post->user? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                            Remove Block<br>
                                                                            <small class="text-muted">Remove Comment - Block User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ $post->user? route('posts.destroyAndRemoveUser', $post->user->id): '' }}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                            Remove User<br>
                                                                            <small class="text-muted">Remove Account - IMEI</small>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="content mb-2">
                                                        {{ $subComment->content }}
                                                    </div>
                                                    <div class="actions d-flex align-items-center gap-2">
                                                        <button type="button" class="btn rounded-pill btn-icon btn-label-primary btn-sm">
                                                            <span class="tf-icons bx bx-like"></span>
                                                        </button>
                                                        <button type="button" class="btn p-0 btn-reply">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center m-0">No comments yet.</p>
                        @endforelse
                    </div>
                    <div class="card-footer">
                        <div class="comment-editor border rounded">
                            <textarea rows="5" placeholder="Write a comment..." class="form-control w-100 d-block border-0 p-2 shadow-none"></textarea>
                            <div class="footer d-flex align-items-center justify-content-between p-2">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('/assets/img/avatars/20.png')  }}" class="rounded-circle">
                                </div>
                                <div class="actions d-flex align-items-center gap-2">
                                    <i class='bx bx-camera' @click="$refs.commentAttachmentInput.click()">
                                        <input x-ref="commentAttachmentInput" type="file" style="visibility:hidden; height: 0; width: 0;">
                                    </i>
                                    <button class="btn btn-primary btn-sm">Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="showReportedComments">
                    <div class="card-header flex-grow-0 border-bottom">
                        <div class="d-flex">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                <div class="me-2">
                                    <h5 class="mb-0">Reported Comments ({{ $reportedComments->count() }})</h5>
                                </div>
                                <div class="dropup d-none d-sm-block">
                                    <button class="btn p-0" type="button" @click="showReportedComments = false">
                                        <i class="tf-icons bx bx-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body comment-box py-3" style="overflow: hidden; overflow-y:auto;">
                        @forelse($reportedComments as $comment)
                        <div class="comment {{ !$loop->last? 'border-bottom mb-3': '' }}">
                            <div class="d-flex">
                                <div>
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('storage/' . ($comment->user && $comment->user->image? $comment->user->image: '../assets/img/avatars/20.png'))  }}" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="pb-2 {{ $comment->subComments->count() > 0? 'border-bottom mb-3': '' }}">
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 text-dark">{{ $comment->user? $comment->user->name: '' }}</p>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                @if ($comment->reports()->where('status', 0)->get()->count() > 0)
                                                <i class='bx bxs-flag-alt text-danger me-4'></i>
                                                @endif
                                                <div class="dropdown d-none d-sm-block">
                                                    <button class="btn p-0" type="button" id="sharedList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList" style="">
                                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                Remove Comment<br>
                                                                <small class="text-muted">Comment removed only</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove - Flag User<br>
                                                                <small class="text-muted">Remove Comment - Flag User</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove Block<br>
                                                                <small class="text-muted">Remove Comment - Block User</small>
                                                            </button>
                                                        </form>
                                                        <form action="{{ $post->user? route('posts.destroyAndRemoveUser', $post->user->id): '' }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="{{ $post->user? 'submit': 'button' }}" class="dropdown-item">
                                                                Remove User<br>
                                                                <small class="text-muted">Remove Account - IMEI</small>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content mb-2">
                                            {{ $comment->content }}
                                        </div>
                                        <div class="actions d-flex align-items-center gap-2">
                                            <button type="button" class="btn rounded-pill btn-icon btn-label-primary btn-sm">
                                                <span class="tf-icons bx bx-like"></span>
                                            </button>
                                            <button type="button" class="btn p-0 btn-reply">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center m-0">No reported comments found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Post -->
        @empty
        @if($show == "all" || $show =="fanpage" || $show == "reported" || $show == "admin")
        <p class="text-center"><b>No posts found.</b></p>
        @endif
        @endforelse
        {{-- @endif --}}

        @if($show == "background")
        @include('content.include.FeedBackground.backgroundFeed')
        @endif
        @if($show == "animated")
        @include('content.include.AnimatedEmoji.animatedFeed')
        @endif
    </div>
    <div class="d-none d-md-block col-md-3"></div>
</div>

{{-- <x-modal
    id="createModal"
    title="Add Post" 
    saveBtnText="Create"
    saveBtnType="submit"
    saveBtnForm="createForm"
    :show="old('showCreateFormModal')? true: false"
  >
    @include('content.posts.includes.create_form')
  </x-modal> --}}
{{-- Create Backgournd  model --}}
@if($show == "background")
    <x-modal id="createBackgroundModel" title="Create Background" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm" size="md">
        @include('content.include.FeedBackground.createForm')
    </x-modal>
@endif

@if($show == "animated")
    <x-modal id="createAnimatedModel{{ $show }}" title="Create Emoji" saveBtnText="Create" saveBtnType="submit" saveBtnForm="createForm{{ $show }}" size="md">
        @include('content.include.AnimatedEmoji.createForm')
    </x-modal>
@endif

<script>
  function confirmAction(event, callback) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to Remove  this Feed?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Remove it!',
      customClass: {
        confirmButton: 'btn btn-danger me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        callback();
      }
    });
  }
   function confirmActionFlag(event, callback) {
    event.preventDefault();

    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to  Flag this user?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Flag it!',
      customClass: {
        confirmButton: 'btn btn-danger me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        callback();
      }
    });
  }
  function confirmActionBlock(event, callback) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to  Block this user?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Block it!',
      customClass: {
        confirmButton: 'btn btn-danger me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        callback();
      }
    });
  }
   function confirmActionAccount(event, callback) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to  Block this account?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Block it!',
      customClass: {
        confirmButton: 'btn btn-danger me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        callback();
      }
    });
  }
  @error('image')
  window.addEventListener('load' , function(){
    const bg_image = document.querySelector('.bg_image');
    document.querySelector('.add_new').click();
  })
@enderror

@php
$field_id =null;
foreach($errors->keys() as $errorKey){

    if (str_starts_with($errorKey, 'image_') && $errorKey !== 'image_'){
        $field_id = explode('_', $errorKey)[1];
    }
}
@endphp
@error('image_*')

  window.addEventListener('load' , function(){

    document.querySelector('#openEditModal{{ $field_id }}').click();
  })
@enderror

@error('emoji')
window.addEventListener('load' , function(){
    document.querySelector('.emoji_new').click();
})
@enderror
@php
$field_id =null;
foreach($errors->keys() as $errorKey){

    if (str_starts_with($errorKey, 'emoji_') && $errorKey !== 'emoji_'){
        $field_id = explode('_', $errorKey)[1];
    }
}
@endphp
@error('emoji_*')
  window.addEventListener('load' , function(){
    document.querySelector('#openEditModal{{ $field_id }}').click();
  })
@enderror
  </script>
  <script>
    function drpzone_init() {
        dropZoneInitFunctions.forEach(callback => callback());
    }
  </script>
  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js" onload="drpzone_init()"></script>
@endsection
