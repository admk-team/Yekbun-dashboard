<form id="editForm{{ $musics->id }}" method="POST" action="{{ route('music.update',$musics->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h5 class="mb-4">Music</h5>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Title</label>
                    <input type="text" id="audio{{ $musics->id }}" class="form-control"  name="title" value="{{ $musics->name ?? '' }}" readonly>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Category Name</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Select</option>
                        @foreach($music_category as $audio)
                        <option value="{{ $audio->id }}" {{ $musics->category_id == $audio->id ? 'selected' : '' }}>{{ $audio->name ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="fullname">Audio</label>
                    <input type="file" name="audio[]" class="form-control" id="audioFile{{ $musics->id }}" accept="audio/*" multiple />
                    {{-- @foreach($arr as $key => $value)
                    <?php
                      $getaudio = $value ?? null; 
                    ?>
                    <audio controls>
                        <source src="{{ asset('storage/'.$getaudio)}}" /></audio><br>
                    @endforeach --}}
                    @error('audio')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById("audioFile{{ $musics->id }}").addEventListener("change", function() {
        if(this.files.length == 1){
            let file = this.files[0];
            let title = file.name;
            document.getElementById('audio{{ $musics->id }}').value = 'audio';
            document.getElementById('audio{{ $musics->id }}').value = title;
        }else{
            let file = this.files[0];
            let title = file.name;
            document.getElementById('audio{{ $musics->id }}').value = 'audio';
            document.getElementById('audio{{ $musics->id }}').value = title;
            
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
        }
    
    
    });
    </script>