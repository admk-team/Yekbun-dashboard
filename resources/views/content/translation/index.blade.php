@extends('layouts/layoutMaster')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
@endsection

@section('content')

<!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">Text</h5>
        @can('voting.create')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createvotingModal"><i class="bx bx-plus me-0 me-sm-1"></i> Add Vote</button>
        @endcan
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Text</th> 
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @forelse($texts as $text)
        <tr>
          <td>{{ $loop->iteration }}</td>
            <td>{{ $text->text ?? '' }}</td>
            <td> 
               <form action="{{ route('translation.translate',$text->id) }}"  id="delete_form">
              @csrf
              <button type="submit" class="btn btn-warning btn-sm">Translate</button>
          </form>
        </td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="8"><b>No Voting found.<b></td>
        </tr>
        @endforelse
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

{{-- Create Vote model --}}
{{-- <x-modal 
id="createvotingModal" 
title="Create Vote"
saveBtnText="Create" 
saveBtnType="submit"
saveBtnForm="createForm" 
size="lg">
 @include('content.include.voting.createForm')
</x-modal> --}}


<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script>
    (function() {
        // Full Toolbar
        // --------------------------------------------------------------------
        const fullToolbar = [
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
        const fullEditor = new Quill('#inputDescription', {
            bounds: '#full-editor'
            , placeholder: 'Type Something...'
            , modules: {
                formula: true
                , toolbar: fullToolbar
            }
            , theme: 'snow'
        });

    }());

</script>

@endsection

@section('page-script')
<script>
  function confirmAction(event, callback) {
    event.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to delete this?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
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
</script>

<script>
// bootstrap-maxlength & repeater (jquery)
$(function () {
  //var maxlengthInput = $('.bootstrap-maxlength-example'),
    var formRepeater = $('.form-repeater');

  // Bootstrap Max Length
  // --------------------------------------------------------------------
//   if (maxlengthInput.length) {
//     maxlengthInput.each(function () {
//       $(this).maxlength({
//         warningClass: 'label label-success bg-success text-white',
//         limitReachedClass: 'label label-danger',
//         separator: ' out of ',
//         preText: 'You typed ',
//         postText: ' chars available.',
//         validate: true,
//         threshold: +this.getAttribute('maxlength')
//       });
//     });
//   }

  // Form Repeater
  // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
  // -----------------------------------------------------------------------------------------------------------------

  if (formRepeater.length) {
    var row = 2;
    var col = 1;
    formRepeater.on('submit', function (e) {
      e.preventDefault();
    });
    formRepeater.repeater({
        // initEmpty: true,
      show: function () {
        var fromControl = $(this).find('.form-control, .form-select');
        var formLabel = $(this).find('.form-label');

        fromControl.each(function (i) {
          var id = 'form-repeater-' + row + '-' + col;
          $(fromControl[i]).attr('id', id);
          $(formLabel[i]).attr('for', id);
          col++;
        });

        row++;

        $(this).slideDown();
      },
      hide: function (e) {
        $(this).slideUp(e);
      }
    });
  }
});
</script>
@endsection
