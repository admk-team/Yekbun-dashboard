@extends('layouts/layoutMaster')

@section('title', 'Posts - List')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery.min.css"
        integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
 
@endsection
<style>
    .light-gallery {
        width: 100%
        margin: 5rem auto 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 100px 100px;
        overflow: hidden;
        gap: 0;
    }

    .light-gallery img {
        width: 100%;
    }

    .lg-thumb.lg-group {
        display: flex;
        width: 100%;
    }

    .lg-thumb.lg-group>div {
        width: 100px;
        overflow: hidden;
    }

    .lg-thumb.lg-group>div>img {
        width: 100%;
        height: auto;
    }

    .lg-backdrop {
        z-index: 10000 !important;
    }

    .lg-outer {
        z-index: 20000 !important;
    }
    .lg-item.lg-loaded.lg-current.lg-complete.lg-complete_ {
            display: flex !important;
            align-items: center;
            justify-content: center;
  }
  .single{
    height: 328px !important;
  }
</style>

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-icons.css') }}" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.umd.js"
    integrity="sha512-hTxPc7AKRjkXWaLJrpFNAaDg6k2dlcFr83GY/A6QCcG9frr2fLvZx/bc8rTnNkoOXTSQsW0EkFSb1KvHQMVksQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.umd.js"
    integrity="sha512-ZvU4G9xWusAdzVzfexL3K5JBW1V+53Y0NTLMIEvap1/ClDFGghKPw8jEsmsyVc/HWm5gA/sRZJoeUi88rVX+PA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.umd.js"
    integrity="sha512-cG/6qcKX9JkbA8kJ7yZulIMXp3l2rQrwmr24BBLNo777SYcuDZUsIbkBNaCnoFr45hIPSfGXhwTn7bWyvNWmEQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/video/lg-video.umd.min.js" integrity="sha512-olksMIiITctwLVsKDH2fm9nylHHYzK2v/bIY+LzBO9GAw9A44MBjYaJGm/2eIbhTtXZXdXQUoS17HoV2rI+fFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
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
        </a> --}}
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
        <div class="col-12 {{ $show == 'background' || $show == 'animated' ? 'col-md-9' : 'col-md-6' }} ">
            {{-- @if ($show != 'background' || $show != 'animated') --}}
            @forelse($posts as $post)
                @php
                    $reportedComments = $post
                        ->comments()
                        ->whereExists(function ($query) {
                            $query
                                ->select(DB::raw(1))
                                ->from('reports')
                                ->whereColumn('reports.reported_comment_id', 'comments.id')
                                ->where('status', 0);
                        })
                        ->get();
                @endphp
                <!-- Start: Post -->
                <div x-data="{ showComments: false, showReportedComments: false }">
                    <div class="card  mb-4">
                        <div x-show="!showComments && !showReportedComments">
                            <div class="card-header flex-grow-0">
                                <div class="d-flex">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('storage/' . ($post->users && $post->users->image ? $post->users->image : '../assets/img/avatars/20.png')) }}"
                                            alt="User" class="rounded-circle"
                                            onerror="this.src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                        <div class="me-2">
                                            <h5 class="mb-0">{{ $post->users ? $post->users->name : 'Admin' }}</h5>
                                            <small class="text-muted">{{ $post->created_at->format('d M Y') }} at
                                                {{ $post->created_at->format('h:i A') }}</small>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @if ($post->reports()->where('status', 0)->get()->count() > 0)
                                                <i class='bx bxs-flag-alt text-danger me-4'></i>
                                            @endif
                                            @if ($reportedComments->count() > 0)
                                                <button @click="showReportedComments = !showReportedComments"
                                                    class="btn me-3 btn-dang er btn-xs">Reported Comments
                                                    ({{ $reportedComments->count() }})</button>
                                            @endif
                                            <div class="dropup d-none d-sm-block">
                                                <button class="btn p-0" type="button" id="sharedList"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sharedList"
                                                    style="">
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post"
                                                        onsubmit="confirmAction(event, () => event.target.submit())">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="top" data-bs-html="true">
                                                            Remove Feed<br>
                                                            <small class="text-muted">Feed removed only</small>
                                                        </button>
                                                    </form>

                                                    <form
                                                        action="{{ $post->users ? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->users->id]) : '' }}"
                                                        method="post" {!! $post->users ? 'onsubmit="confirmActionFlag(event, () => event.target.submit())"' : '' !!}>
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="{{ $post->users ? 'submit' : 'button' }}"
                                                            {!! $post->users ? '' : 'onclick="confirmActionFlag(event, () => event.target.click())"' !!} class="dropdown-item"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="top" data-bs-html="true">
                                                            Remove - Flag User<br>
                                                            <small class="text-muted">Remove Feed - Flag User</small>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ $post->users ? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->users->id]) : '' }}"
                                                        method="post" {!! $post->users ? 'onsubmit="confirmActionBlock(event, () => event.target.submit())"' : '' !!}>
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="{{ $post->users ? 'submit' : 'button' }}"
                                                            {!! $post->users ? '' : 'onclick="confirmActionBlock(event, () => event.target.click())"' !!} class="dropdown-item"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="top" data-bs-html="true">
                                                            Remove Block<br>
                                                            <small class="text-muted">Remove Feed - Block User</small>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ $post->users ? route('posts.destroyAndRemoveUser', $post->users->id) : '' }}"
                                                        method="post" {!! $post->users ? 'onsubmit="confirmActionAccount(event,() => event.target.submit())"' : '' !!}>
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            type="{{ $post->users ? 'submit' : 'button' }}"{!! $post->users ? '' : 'onclick="confirmActionAccount(event,() => event.target.click())"' !!}
                                                            class="dropdown-item" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4" data-bs-placement="top"
                                                            data-bs-html="true">
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
                                @if ($post->gallery)
                                        
                                        <div id="lightgallery{{ $post->id }}" class="light-gallery row p-0 m-0">
                                        @foreach ($post->gallery as $i => $gallery)
                                            {{-- <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                                @if ($gallery->media_type == 0)
                                                    <img class="w-100" src="{{ $gallery->media_url }}"
                                                        alt="Card image cap">
                                                @elseif($gallery->media_type == 1)
                                                    <video controls autoplay muted height="100%" width="100%"
                                                        src="{{ $gallery->media_url }}" style="object-fit:cover">
                                                    </video>
                                                @endif

                                            </div> --}}
                                            @if ($gallery->media_type == 0)
                                                <div class="{{ $i <= 3? 'show': '' }} {{ $i === 3? 'last': '' }} {{ count($post->gallery) === 1 ? 'col-12 single' : 'col-6' }} m-0 p-0" data-src="{{ $gallery->media_url }}" style="height: 164px;
                                                    overflow: hidden;{{ $i > 3? 'display:none;': '' }}">
                                                  <img alt="" src="{{ $gallery->media_url }}" style="width: 100%; height: auto; min-height: 100%;" />
                                                </div>
                                            @endif
                                            @if ($gallery->media_type == 1)
                                            <div style="height: 164px; overflow: hidden;{{ $i > 3? 'display:none;': '' }}"class="{{ $i <= 3? 'show': '' }} {{ $i === 3? 'last': '' }} col-6 m-0 p-0"data-lg-size="1280-720"data-video='{"source": [{"src":"{{ $gallery->media_url }}", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}'>
                                                 <img style="height: 100%; width:100%"
                                                    class="img-responsive"
                                                    src="https://www.intermedia-solutions.net/wp-content/uploads/2021/06/video-thumbnail-01.jpg"
                                                /> 
                                            </div>
                                        @endif
                                        @endforeach
                                            </div>
                                @endif
                            
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
                                        <a href="javascript:;" class="text-muted me-3"><i class="bx bx-heart me-1"></i>
                                            236</a>
                                        <a @click="showComments = ! showComments" href="javascript:;"
                                            class="text-muted me-3"><i class="bx bx-message me-1"></i> 12</a>
                                        <a href="javascript:;" class="text-muted"><i class="bx bx-share me-1"></i> 5</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="showComments" x-cloak>
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
                                    <div class="comment {{ !$loop->last ? 'border-bottom mb-3' : '' }}">
                                        <div class="d-flex">
                                            <div>
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <img src="{{ asset('storage/' . ($comment->user && $comment->user->image ? $comment->user->image : '../assets/img/avatars/20.png')) }}"
                                                        class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div
                                                    class="pb-2 {{ $comment->subComments->count() > 0 ? 'border-bottom mb-3' : '' }}">
                                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <p class="mb-0 text-dark">
                                                                {{ $comment->user ? $comment->user->name : '' }}</p>
                                                            <small
                                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            @if ($comment->reports()->where('status', 0)->get()->count() > 0)
                                                                <i class='bx bxs-flag-alt text-danger me-4'></i>
                                                            @endif
                                                            <div class="dropdown d-none d-sm-block">
                                                                <button class="btn p-0" type="button" id="sharedList"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="sharedList" style="">
                                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">
                                                                            Remove Comment<br>
                                                                            <small class="text-muted">Comment removed
                                                                                only</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove - Flag User<br>
                                                                            <small class="text-muted">Remove Comment - Flag
                                                                                User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove Block<br>
                                                                            <small class="text-muted">Remove Comment -
                                                                                Block User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndRemoveUser', $post->user->id) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove User<br>
                                                                            <small class="text-muted">Remove Account -
                                                                                IMEI</small>
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
                                                        <button type="button"
                                                            class="btn rounded-pill btn-icon btn-label-primary btn-sm">
                                                            <span class="tf-icons bx bx-like"></span>
                                                        </button>
                                                        <button type="button" class="btn p-0 btn-reply">Reply</button>
                                                    </div>
                                                </div>
                                                <div class="sub-comments">
                                                    @foreach ($comment->subComments as $subComment)
                                                        <div
                                                            class="sub-comment {{ !$loop->last ? 'border-bottom pb-2 mb-3' : '' }}">
                                                            <div class="d-flex">
                                                                <div>
                                                                    <div class="avatar flex-shrink-0 me-3">
                                                                        <img src="{{ asset('storage/' . ($subComment->user && $subComment->user->image ? $subComment->user->image : '../assets/img/avatars/20.png')) }}"
                                                                            class="rounded-circle">
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div
                                                                        class="mb-2 d-flex align-items-center justify-content-between">
                                                                        <div>
                                                                            <p class="mb-0 text-dark">
                                                                                {{ $subComment->user ? $subComment->user->name : '' }}
                                                                            </p>
                                                                            <small
                                                                                class="text-muted">{{ $subComment->created_at->diffForHumans() }}</small>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            @if ($subComment->reports()->where('status', 0)->get()->count() > 0)
                                                                                <i
                                                                                    class='bx bxs-flag-alt text-danger me-4'></i>
                                                                            @endif
                                                                            <div class="dropdown d-none d-sm-block">
                                                                                <button class="btn p-0" type="button"
                                                                                    id="sharedList"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    <i class="bx bx-dots-vertical"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown-menu-end"
                                                                                    aria-labelledby="sharedList"
                                                                                    style="">
                                                                                    <form
                                                                                        action="{{ route('posts.destroy', $post->id) }}"
                                                                                        method="post">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button type="submit"
                                                                                            class="dropdown-item">
                                                                                            Remove Comment<br>
                                                                                            <small
                                                                                                class="text-muted">Comment
                                                                                                removed only</small>
                                                                                        </button>
                                                                                    </form>
                                                                                    <form
                                                                                        action="{{ $post->user ? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                                        method="post">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button
                                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                                            class="dropdown-item">
                                                                                            Remove - Flag User<br>
                                                                                            <small
                                                                                                class="text-muted">Remove
                                                                                                Comment - Flag User</small>
                                                                                        </button>
                                                                                    </form>
                                                                                    <form
                                                                                        action="{{ $post->user ? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                                        method="post">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button
                                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                                            class="dropdown-item">
                                                                                            Remove Block<br>
                                                                                            <small
                                                                                                class="text-muted">Remove
                                                                                                Comment - Block User</small>
                                                                                        </button>
                                                                                    </form>
                                                                                    <form
                                                                                        action="{{ $post->user ? route('posts.destroyAndRemoveUser', $post->user->id) : '' }}"
                                                                                        method="post">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button
                                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                                            class="dropdown-item">
                                                                                            Remove User<br>
                                                                                            <small
                                                                                                class="text-muted">Remove
                                                                                                Account - IMEI</small>
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
                                                                        <button type="button"
                                                                            class="btn rounded-pill btn-icon btn-label-primary btn-sm">
                                                                            <span class="tf-icons bx bx-like"></span>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn p-0 btn-reply">Reply</button>
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
                                    <textarea rows="5" placeholder="Write a comment..."
                                        class="form-control w-100 d-block border-0 p-2 shadow-none"></textarea>
                                    <div class="footer d-flex align-items-center justify-content-between p-2">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="{{ asset('/assets/img/avatars/20.png') }}" class="rounded-circle">
                                        </div>
                                        <div class="actions d-flex align-items-center gap-2">
                                            <i class='bx bx-camera' @click="$refs.commentAttachmentInput.click()">
                                                <input x-ref="commentAttachmentInput" type="file"
                                                    style="visibility:hidden; height: 0; width: 0;">
                                            </i>
                                            <button class="btn btn-primary btn-sm">Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="showReportedComments" x-cloak>
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
                                    <div class="comment {{ !$loop->last ? 'border-bottom mb-3' : '' }}">
                                        <div class="d-flex">
                                            <div>
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <img src="{{ asset('storage/' . ($comment->user && $comment->user->image ? $comment->user->image : '../assets/img/avatars/20.png')) }}"
                                                        class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div
                                                    class="pb-2 {{ $comment->subComments->count() > 0 ? 'border-bottom mb-3' : '' }}">
                                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <p class="mb-0 text-dark">
                                                                {{ $comment->user ? $comment->user->name : '' }}</p>
                                                            <small
                                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            @if ($comment->reports()->where('status', 0)->get()->count() > 0)
                                                                <i class='bx bxs-flag-alt text-danger me-4'></i>
                                                            @endif
                                                            <div class="dropdown d-none d-sm-block">
                                                                <button class="btn p-0" type="button" id="sharedList"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="bx bx-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="sharedList" style="">
                                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">
                                                                            Remove Comment<br>
                                                                            <small class="text-muted">Comment removed
                                                                                only</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndFlagUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove - Flag User<br>
                                                                            <small class="text-muted">Remove Comment - Flag
                                                                                User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndBlockUser', ['id' => $post->id, 'user_id' => $post->user->id]) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove Block<br>
                                                                            <small class="text-muted">Remove Comment -
                                                                                Block User</small>
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ $post->user ? route('posts.destroyAndRemoveUser', $post->user->id) : '' }}"
                                                                        method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="{{ $post->user ? 'submit' : 'button' }}"
                                                                            class="dropdown-item">
                                                                            Remove User<br>
                                                                            <small class="text-muted">Remove Account -
                                                                                IMEI</small>
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
                                                        <button type="button"
                                                            class="btn rounded-pill btn-icon btn-label-primary btn-sm">
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
                <script>
                    lightGallery(document.getElementById('lightgallery{{ $post->id }}'), {
                      plugins: [lgZoom, lgThumbnail , lgVideo],
                        licenseKey: 'your_license_key',
                        speed: 500,
                    });
                
                    window.addEventListener('load', () => {
                      const gallery = document.getElementById('lightgallery{{ $post->id }}');
                      const items = gallery.querySelectorAll('div');
                
                      Array.from(items).map((item) => {
                        if (! item.classList.contains('show')) {
                          item.style.display = 'none';
                        }
                
                        if (item.classList.contains('last') && items.length > 4) {
                          item.style.position = 'relative';
                          const overlay = document.createElement('div');
                          overlay.style.backgroundColor = 'rgba(0, 0, 0, .3)';
                          overlay.style.width = '100%';
                          overlay.style.height = '100%';
                          overlay.style.top = '0';
                          overlay.style.left = '0';
                          overlay.style.position = 'absolute';
                          item.appendChild(overlay);
                          const countText = document.createElement('div');
                          const text = document.createTextNode(`Show More (${items.length - 4})`);
                          countText.appendChild(text);
                          countText.style.position = 'absolute';
                          countText.style.top = '0';
                          countText.style.left = '0';
                          countText.style.zIndex = '30';
                          countText.style.color = 'white';
                          countText.style.width = '100%';
                          countText.style.height = '100%';
                          countText.style.display = 'flex';
                          countText.style.alignItems = 'center';
                          countText.style.justifyContent = 'center';
                          countText.style.fontFamily = 'arial';
                          countText.style.cursor = 'pointer';
                          countText.style.fontWeight = '600';
                          item.appendChild(countText);
                
                        }
                      })
                    });
                  </script>
            @empty
                @if ($show == 'all' || $show == 'fanpage' || $show == 'reported' || $show == 'admin')
                    <p class="text-center"><b>No posts found.</b></p>
                @endif
            @endforelse
            {{-- @endif --}}

            @if ($show == 'background')
                @include('content.include.FeedBackground.backgroundFeed')
            @endif
            @if ($show == 'animated')
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
    @if ($show == 'background')
        <x-modal id="createBackgroundModel" title="Create Background" saveBtnText="Create" saveBtnType="submit"
            saveBtnForm="createForm" size="md">
            @include('content.include.FeedBackground.createForm')
        </x-modal>
    @endif

    @if ($show == 'animated')
        <x-modal id="createAnimatedModel{{ $show }}" title="Create Emoji" saveBtnText="Create"
            saveBtnType="submit" saveBtnForm="createForm{{ $show }}" size="md">
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
            }).then(function(result) {
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
            }).then(function(result) {
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
            }).then(function(result) {
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
            }).then(function(result) {
                if (result.value) {
                    callback();
                }
            });
        }
        @error('image')
            window.addEventListener('load', function() {
                const bg_image = document.querySelector('.bg_image');
                document.querySelector('.add_new').click();
            })
        @enderror

        @php
            $field_id = null;
            foreach ($errors->keys() as $errorKey) {
                if (str_starts_with($errorKey, 'image_') && $errorKey !== 'image_') {
                    $field_id = explode('_', $errorKey)[1];
                }
            }
        @endphp
        @error('image_*')

            window.addEventListener('load', function() {

                document.querySelector('#openEditModal{{ $field_id }}').click();
            })
        @enderror

        @error('emoji')
            window.addEventListener('load', function() {
                document.querySelector('.emoji_new').click();
            })
        @enderror
        @php
            $field_id = null;
            foreach ($errors->keys() as $errorKey) {
                if (str_starts_with($errorKey, 'emoji_') && $errorKey !== 'emoji_') {
                    $field_id = explode('_', $errorKey)[1];
                }
            }
        @endphp
        @error('emoji_*')
            window.addEventListener('load', function() {
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
