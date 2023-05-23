<div class="nav-align-top mb-4">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-en" aria-controls="navs-top-home" aria-selected="true">En</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-de" aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">DE</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-kr" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">KR</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tr" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">TR</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-ir" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">IR</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-en" role="tabpanel">
            <form id="createForm" method="POST" action="{{ route('vote.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $vote)
                                        <option value="{{ $vote->id }}">{{ $vote->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription"></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <!-- Form Repeater -->
                                <div class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-9 col-12 mb-0">
                                                    <input type="text" id="form-repeater-1-1" class="form-control" name="option" placeholder="Option" />
                                                </div>
                                                <div class="col-lg-3 col-12 d-flex align-items-center mb-0">
                                                    <button type="button" class="btn btn-label-danger" data-repeater-delete>
                                                    <i class="bx bx-x me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="bx bx-plus me-1"></i>
                                            <span class="align-middle">Add More Fields</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /Form Repeater -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="navs-de" role="tabpanel">
            <form id="createForm" method="POST" action="{{ route('vote.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $vote)
                                        <option value="{{ $vote->id }}">{{ $vote->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription"></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <!-- Form Repeater -->
                                <div class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-9 col-12 mb-0">
                                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Option" />
                                                </div>
                                                <div class="col-lg-3 col-12 d-flex align-items-center mb-0">
                                                    <button type="button" class="btn btn-label-danger" data-repeater-delete>
                                                    <i class="bx bx-x me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="bx bx-plus me-1"></i>
                                            <span class="align-middle">Add More Fields</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /Form Repeater -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="navs-kr" role="tabpanel">
            <form id="createForm" method="POST" action="{{ route('vote.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $vote)
                                        <option value="{{ $vote->id }}">{{ $vote->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription"></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <!-- Form Repeater -->
                                <div class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-9 col-12 mb-0">
                                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Option" />
                                                </div>
                                                <div class="col-lg-3 col-12 d-flex align-items-center mb-0">
                                                    <button type="button" class="btn btn-label-danger" data-repeater-delete>
                                                    <i class="bx bx-x me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="bx bx-plus me-1"></i>
                                            <span class="align-middle">Add More Fields</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /Form Repeater -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="navs-tr" role="tabpanel">
            <form id="createForm" method="POST" action="{{ route('vote.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $vote)
                                        <option value="{{ $vote->id }}">{{ $vote->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription"></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <!-- Form Repeater -->
                                <div class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-9 col-12 mb-0">
                                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Option" />
                                                </div>
                                                <div class="col-lg-3 col-12 d-flex align-items-center mb-0">
                                                    <button type="button" class="btn btn-label-danger" data-repeater-delete>
                                                    <i class="bx bx-x me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="bx bx-plus me-1"></i>
                                            <span class="align-middle">Add More Fields</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /Form Repeater -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="navs-ir" role="tabpanel">
            <form id="createForm" method="POST" action="{{ route('vote.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Title</label>
                                <input type="text" id="fullname" class="form-control" placeholder="title" name="name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Banner upload</label>
                                <input type="file" id="fullname" class="form-control" name="image">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Choose a Category</option>
                                    @foreach($vote_category as $vote)
                                        <option value="{{ $vote->id }}">{{ $vote->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fullname">Description</label>
                                <textarea class="form-control" name="description" style="height:150px;" id="inputDescription"></textarea>
                            </div>
                            <div class="col-md-12 mt-5">
                                <!-- Form Repeater -->
                                <div class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-lg-9 col-12 mb-0">
                                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Option" />
                                                </div>
                                                <div class="col-lg-3 col-12 d-flex align-items-center mb-0">
                                                    <button type="button" class="btn btn-label-danger" data-repeater-delete>
                                                    <i class="bx bx-x me-1"></i>
                                                    <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="bx bx-plus me-1"></i>
                                            <span class="align-middle">Add More Fields</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /Form Repeater -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>