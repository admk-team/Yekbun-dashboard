@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection
@section('content')

{{-- Nav TAb --}}
<div class="d-flex justify-content-between">
    <div>
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Policy and Terms /</span> All Policy and Terms
        </h4>
    </div>
    <div>
      <button class="btn btn-primary" data-bs-target="#addnewtab" data-bs-toggle="modal">Add New Tab</button>
    </div>
</div>

<div class="modal fade" id="addnewtab" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel3">Add Tab</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <form id="createForm" method="POST" action="">
                      @csrf
                      <div class="col mb-3">
                          <label for="nameLarge" class="form-label">Tab Name</label>
                          <input type="text" id="nameLarge" class="form-control" placeholder="Add Tab Name Here" name="">
                      </div>
                      <div class="col mb-3">
                        <label for="nameLarge" class="form-label">Tab Icon</label>
                        <input type="text" id="nameLarge" class="form-control" placeholder="Add Tab Icon" name="">
                    </div>
                  </form>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-primary">Save</button>
          </div>
      </div>
  </div>
</div>

<div class="row">
        <h6 class="text-muted">Privacy and Terms</h6>
        <div class="nav-align-left mb-4">
            <div class="col-md-2">
            <ul class="nav nav-pills me-3" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#privacy" aria-controls="privacy" aria-selected="true" ><i class='bx bx-file'></i>&nbsp;Privacy Policy</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#disclaimer" aria-controls="disclaimer" aria-selected="false"><i class='bx bx-file'></i>&nbsp;Disclaimer</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#news" aria-controls="news" aria-selected="false"><i class='bx bx-news' ></i>&nbsp;News</button>
                </li>
            </ul>
        </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="privacy" role="tabpanel">
                      <form action="{{ route('policy_and_terms.store') }}" method="POST">
                        @csrf
                        <input type = "hidden" name="privacy" value="privacy_policy"/>  
                        <label class="form-label" for="inputDescription">Description</label>
                        <textarea id="inputDescription" name="policy_text" class="form-control" placeholder="Event Description" rows="6" value={{ $policy->description ?? '' }}>
                            {{ old('description') }}
                        </textarea>
                        @error('policy')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Save</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="disclaimer" role="tabpanel">
                    <form action="{{ route('policy_and_terms.store') }}" method="POST">
                        @csrf
                        <input type = "hidden" name="disclaimer" value="disclaimer"/>  
                        <label class="form-label" for="inputDescription">Description</label>
                        <textarea id="inputDescription" name="disclaimer_text" class="form-control" placeholder="Event Description" rows="6"  value={{ $policy->description ?? '' }}>{{ old('description') }}</textarea>
                        @error('disclaimer')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Save</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="news" role="tabpanel">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="label" class="form-label">Credit Card Type</label>
                      </div>
                      <div class="col-md-4">
                        <select  class="form-select">
                          <option selected>Choose Credit Card</option>
                          <option>American Express</option>
                          <option>Master Card</option>
                          <option>Visa Card</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-2">
                        <label for="label" class="form-label">Expiration</label>
                      </div>
                      <div class="col-md-4">
                        <select  class="form-select">
                          <option selected>Date Month</option>
                          <option>01- Jan</option>
                          <option>02- Feb</option>
                          <option>03- March</option>
                          <option>04- April</option>
                          <option>05- May</option>
                          <option>06- June</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select  class="form-select">
                          <option selected>Year</option>
                          <option>2007</option>
                          <option>2008</option>
                          <option>2009</option>
                          <option>2010</option>
                          <option>2011</option>
                          <option>2012</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="row mt-2">
                      <div class="col-md-2">
                        <label for="label" class="form-label">Credit Card Number</label>
                      </div>
                      <div class="col-md-4">
                        <input type="text" class="form-control" />
                      </div>
                    </div>
                </div>
        </div>
        </div>
    </div>
@section('page-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script>
    function confirmAction(event, callback) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?'
            , text: "Are you sure you want to delete this?"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'Yes, delete it!'
            , customClass: {
                confirmButton: 'btn btn-danger me-3'
                , cancelButton: 'btn btn-label-secondary'
            }
            , buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                callback();
            }
        });
    }

</script>
<script>
    (function () {


      // Full Toolbar
    // --------------------------------------------------------------------
    const fullToolbar = [
      [
        {
          font: []
        },
        {
          size: []
        }
      ],
      ['bold', 'italic', 'underline', 'strike'],
      [
        {
          color: []
        },
        {
          background: []
        }
      ],
      [
        {
          script: 'super'
        },
        {
          script: 'sub'
        }
      ],
      [
        {
          header: '1'
        },
        {
          header: '2'
        },
        'blockquote',
        'code-block'
      ],
      [
        {
          list: 'ordered'
        },
        {
          list: 'bullet'
        },
        {
          indent: '-1'
        },
        {
          indent: '+1'
        }
      ],
      [{ direction: 'rtl' }],
      ['link', 'image', 'video', 'formula'],
      ['clean']
    ];
   
    const fullEditor = new Quill('#inputDescription', {
      bounds: '#full-editor',
      placeholder: 'Type Something...',
      modules: {
        formula: true,
        toolbar: fullToolbar
      },
      theme: 'snow'
    });
  
  
    }());
  </script>
@endsection
@endsection
