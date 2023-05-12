<form id="editForm{{ $language->id }}" method="POST" action="{{ route('language.update',$language->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Icon</label>
                    <select class="" name="icon"  id="id_select2_example{{ $language->id }}" style="width: 200px;">
                        <span>Choose a language</span>
                        <option value="AE" data-img_src="{{ asset('assets/img/AE.png') }}" {{ $language->icon == "AE" ? 'selected' : ''}}>Arabic</option>
                        <option value="GB" data-img_src="{{ asset('assets/img/GB.png') }}" {{ $language->icon == "GB" ? 'selected' : '' }}>English (GB)</option>
                        <option value="US" data-img_src="{{ asset('assets/img/US.png') }}" {{ $language->icon == "US" ? 'selected' : '' }}>English (USA)</option>
                        <option value="FR" data-img_src="{{ asset('assets/img/FR.png') }}" {{ $language->icon == "FR" ? 'selected' : '' }}>French</option>
                        <option value="DE" data-img_src="{{ asset('assets/img/DE.png') }}" {{ $language->icon == "DE" ? 'selected' : '' }}>Deutsch</option>
                        <option value="IT" data-img_src="{{ asset('assets/img/IT.png') }}" {{ $language->icon == "IT" ? 'selected' : '' }}>Italian</option>
                        <option value="ES" data-img_src="{{ asset('assets/img/ES.png') }}" {{ $language->icon == "ES" ? 'selected' : '' }}>Spanish</option>
                </select>             
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" name="title" class="form-control" id="audioFile" value="{{ $language->title ?? '' }}"  />
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="status">Status</label>
                    <select name="status" class="form-select">
                        <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>Unpublish</option>
                        <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>
           
             
            </div>
        </div>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
<script type="text/javascript">
  function custom_template(obj){
            var data = $(obj.element).data();
            var text = $(obj.element).text();
            if(data && data['img_src']){
                img_src = data['img_src'];
                template = $("<div style=\"display:flex;gap:4px;\"><img src=\"" + img_src + "\" style=\"width:20px;height:20px;border-radius:20px;\"/><p style=\"font-weight: 400;font-size:10pt; margin-top:-5px;\">" + text + "</p></div>");
                return template;
            }
        }
    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    }
    $('#id_select2_example{{ $language->id }}').select2(options);
    $('.select2-container--default .select2-selection--single').css({'height': '47px'});

</script>
