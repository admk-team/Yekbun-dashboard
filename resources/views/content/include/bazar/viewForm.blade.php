<div id="viewForm{{ $bazar->id }}">

    <div class="row">
        <div class="col-lg-12">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="{{ asset('storage/'.$arr[0]) }}" alt="Image" width="100%" height="auto">
                        </div>
                        <div class="col-md-4">
                            @php
                            $firstThreeImages = array_slice($arr, 1, 2);
                            @endphp
                            @foreach ($firstThreeImages as  $img)
                                  <img src="{{ asset('storage/'.$img) }}" alt="Image" width="100%" height="auto"><br><br>
                            @endforeach
                        </div>

                    </div>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <table class="table table-borderless">
                        <h5 class="text-center">{{ $bazar->title ?? '' }}</h5>
                        <thead>
                            <tr>
                                <th>Price</th>
                                <td>{{ $bazar->price ?? '' }}$</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $bazar->status == 0 ? 'Unpublish' : 'Publish' }}</td>
                            </tr>
                            <tr>
                                <th>Warranty</th>
                                <td>{{ $bazar->warranty == 0 ? 'No' : 'Yes' }}</td>
                            </tr>
                        </thead>
                      
                    </table>
                   
                </div>
            </div>
        </div>
            <button class="btn"data-bs-toggle="modal" data-bs-target="#editbazarModal{{ $bazar->id }}">Edit</button>
            
            <form action="{{ route('bazar.destroy', $bazar->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                @method('DELETE')
                @csrf
                <button class="btn">Remove Item</button>
            </form>
    </div>
  
</div>
