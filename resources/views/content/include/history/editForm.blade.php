<form id="editForm{{ $historys->id }}" method="POST" action="{{ route('history.update', $historys->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputCategory{{ $historys->id }}">Select Category</label>
                    <select class="form-select" aria-label="Default select example" id="inputCategory{{ $historys->id }}" name="category_id">
                        <option selected>Choose Category</option>
                        @foreach($history_category as $history)
                        <option value="{{ $history->id }}" {{ (int)$history->id === (int)$historys->history_category->id? 'selected': '' }}>{{ $history->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputTitle{{ $historys->id }}">Title</label>
                    <input type="text" id="inputTitle{{ $historys->id }}" class="form-control" placeholder="Title" name="title" value="{{ $historys->title }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputDescription{{ $historys->id }}">Description</label>
                    <textarea class="form-control" name="description" style="height:150px;" id="inputDescription{{ $historys->id }}" placeholder="Type...">{{ $historys->description }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputDescription">Images Upload</label>
                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputDescription">Video Upload</label>
                    <input type="file" class="form-control" name="video[]" accept="video/*" multiple>
                </div>
                <!-- <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Images Upload</h5>
                        <div class="card-body">
                            <div class="dropzone needsclick" action="/" id="dropzone-img">
                                <div class="dz-message needsclick">
                                    Drop files here or click to upload
                                </div>
                                <div class="fallback">
                                    <input  type="file" name="image[]" accept="image/*" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Video Upload</h5>
                        <div class="card-body">
                             <div class="dropzone needsclick" action="/" id="dropzone-video">
                                <div class="dz-message needsclick">
                                    Drop files here or click to upload
                                </div>
                                <div class="fallback">
                                    <input  type="file" name="video[]" accept="video/*" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

</form>
<script>
    $(document).on('ready', function () {
      $('.dz-dropzone').each(function () {
        // initialization of dropzone file attach module
        var dropzone = $.HSCore.components.HSDropzone.init('#' + $(this).attr('id'));
      });
    });
  </script>

<script>
    'use strict';

    function drpzone_init(){
            // previewTemplate: Updated Dropzone default previewTemplate

            const previewTemplate = `<div class="dz-preview dz-file-preview">
                                    <div class="dz-details">
                                      <div class="dz-thumbnail">
                                        <img data-dz-thumbnail>
                                        <span class="dz-nopreview">No preview</span>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                        <div class="progress">
                                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                                        </div>
                                      </div>
                                      <div class="dz-filename" data-dz-name></div>
                                      <div class="dz-size" data-dz-size></div>
                                    </div>
                                    </div>`;
  
            // Multiple Dropzone

            const dropzoneMulti = new Dropzone('#dropzone-img', {
                previewTemplate: previewTemplate,
                parallelUploads: 1,
                maxFilesize: 5,
                addRemoveLinks: true
            });
            const dropzoneMulti1 = new Dropzone('#dropzone-video', {
                previewTemplate: previewTemplate,
                parallelUploads: 1,
                maxFilesize: 5,
                addRemoveLinks: true
            });


           
        }
  </script> 

<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}" onload="drpzone_init()"></script> 

