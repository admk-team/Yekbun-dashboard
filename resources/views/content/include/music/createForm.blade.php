<form id=createForm method="POST" action="{{ route('music.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Music Title</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Title will add automatically" name="title" readonly>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Select Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected value="">Select</option>
                        @foreach($music_category as $music)
                        <option value="{{ $music->id }}">{{ $music->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Audio</label>
                    <input type="file" name="audio[]" class="form-control" id="audioFile" accept="audio/*" multiple />
                    @error('audio')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                   <div class="col-md-12">
                    <label class="form-label" for="fullname">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected value="">Select</option>
                        <option value="0">UnPublish</option>
                        <option value="1">Publish</option>
                        
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
  
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById("audioFile").addEventListener("change", function() {
    if(this.files.length == 1){
        let file = this.files[0];
        let title = file.name;
        document.querySelector('input[name="title"]').value = title;
    }else{
        
        // document.querySelector('input[name="title"]').value = '';
        // document.querySelector('input[name="title"]').disabled = true;
        // var list = document.createElement("ul");
        // for (let i = 0; i < this.files.length; i++) {
        //     let file = this.files[i];
        //     let title = file.name;
        //     // create a new unordered list element
        //     let item1 = document.createElement("li");
        //     item1.classList.add('h6','mt-2','p-2');
        //     item1.textContent =title;
        //     list.appendChild(item1);
        // // add the list to the document
    
        // }

        // document.querySelector('input[name="title"]').parentElement.appendChild(list);
        let file = this.files[0];
        let title = file.name;
        document.querySelector('input[name="title"]').value = title;
    }


});
</script>