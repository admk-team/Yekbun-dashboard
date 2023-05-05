<style>
    .ql-toolbar.ql-snow {
        overflow: hidden !important;
    }
</style>
<div class="nav-align-top mb-4">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-en{{ $vote->id }}" aria-controls="navs-top-home" aria-selected="true">En</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-de{{ $vote->id }}" aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">DE</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-kr{{ $vote->id }}" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">KR</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tr{{ $vote->id }}" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">TR</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-ir{{ $vote->id }}" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">IR</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-en{{ $vote->id }}" role="tabpanel">
            <form id="editForm" method="POST" action="{{ route('vote.update',$vote->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name" value="{{ $vote->name ?? '' }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                                <!-- <img src="{{ asset('storage/'.$vote->banner) }}"> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $votes)
                                    <option value="{{ $votes->id }}" {{ $vote->category_id == $votes->id ? 'selected' : '' }}>{{ $votes->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputDescription{{ $vote->id }}">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $vote->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane fade" id="navs-de{{ $vote->id }}" role="tabpanel">
            <form id="editForm" method="POST" action="{{ route('vote.update',$vote->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name" value="{{ $vote->name ?? '' }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                                <!-- <img src="{{ asset('storage/'.$vote->banner) }}"> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $votes)
                                    <option value="{{ $votes->id }}" {{ $vote->category_id == $votes->id ? 'selected' : '' }}>{{ $votes->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputDescription{{ $vote->id }}">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $vote->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane fade" id="navs-kr{{ $vote->id }}" role="tabpanel">
            <form id="editForm" method="POST" action="{{ route('vote.update',$vote->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name" value="{{ $vote->name ?? '' }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                                <!-- <img src="{{ asset('storage/'.$vote->banner) }}"> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $votes)
                                    <option value="{{ $votes->id }}" {{ $vote->category_id == $votes->id ? 'selected' : '' }}>{{ $votes->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputDescription{{ $vote->id }}">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $vote->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="tab-pane fade" id="navs-tr{{ $vote->id }}" role="tabpanel">
            <form id="editForm" method="POST" action="{{ route('vote.update',$vote->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name" value="{{ $vote->name ?? '' }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                                <!-- <img src="{{ asset('storage/'.$vote->banner) }}"> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $votes)
                                    <option value="{{ $votes->id }}" {{ $vote->category_id == $votes->id ? 'selected' : '' }}>{{ $votes->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputDescription{{ $vote->id }}">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $vote->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="tab-pane fade" id="navs-ir{{ $vote->id }}" role="tabpanel">
            <form id="editForm" method="POST" action="{{ route('vote.update',$vote->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name" value="{{ $vote->name ?? '' }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                                <!-- <img src="{{ asset('storage/'.$vote->banner) }}"> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $votes)
                                    <option value="{{ $votes->id }}" {{ $vote->category_id == $votes->id ? 'selected' : '' }}>{{ $votes->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputDescription{{ $vote->id }}">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $vote->id }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    
   window.addEventListener('load' , function(){
    (function() {
        // Full Toolbar
        // --------------------------------------------------------------------
        const fullToolbar{{ $vote->id }} = [
            [{
                    font: []
                }
                , {
                    size: []
                }
            ]
            , ['bold', 'italic', 'underline', 'strike']
            , [{
                    color: []
                }
                , {
                    background: []
                }
            ]
            , [{
                    script: 'super'
                }
                , {
                    script: 'sub'
                }
            ]
            , [{
                    header: '1'
                }
                , {
                    header: '2'
                }
                , 'blockquote'
                , 'code-block'
            ]
            , [{
                    list: 'ordered'
                }
                , {
                    list: 'bullet'
                }
                , {
                    indent: '-1'
                }
                , {
                    indent: '+1'
                }
            ]
            , [{
                direction: 'rtl'
            }]
            , ['link', 'image', 'video', 'formula']
            , ['clean']
        ];
        const fullEditor{{ $vote->id }} = new Quill('#inputDescription{{$vote->id }}', {
            bounds: '#full-editor'
            , placeholder: 'Type Something...'
            , modules: {
                formula: true
                , toolbar: fullToolbar{{ $vote->id }}
            }
            , theme: 'snow'
        });

    }());
   })

</script>