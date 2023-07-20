<div class="card">
<div class="table-responsive text-nowrap">
    <table class="table">
      <div class="d-flex justify-content-end mt-2">
      <button class="btn btn-primary add_new" data-bs-toggle="modal" data-bs-target="#createBackgroundModel"><i class="bx bx-plus me-0 me-sm-1"></i>Add new</button>
    </div>
      <thead>
        <tr>
          <th>#</th>
          <th>Background</th>
          <th>Option</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @forelse($background_post as $background)
      <tr>
          <td>{{ $background->id }}</td>
          <td>
            <img src="{{ $background->image }}" width="100" height="100" class="rounded" style="object-fit: cover;">
          </td>
          <td>
              <div class="dropdown d-inline-block">
                  <!-- Edit -->
                  <span data-bs-toggle="modal"  data-bs-target="#editBackgroundModal{{ $background->id }}">
                      <button class="btn btn-sm btn-icon"  id="openEditModal{{ $background->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Edit" aria-describedby="tooltip557134">
                          <i class="bx bx-edit"></i>
                      </button>
                  </span>
           
                  <!-- Delete -->
                  <form action="{{ route('backgrond-feed.destroy',$background->id) }}" onsubmit="confirmAction(event, () => event.target.submit())" method="post" class="d-inline">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="Remove"><i class="bx bx-trash me-1"></i></button>
                  </form>
              </div>
              {{-- Edit Model Form --}}
              <x-modal id="editBackgroundModal{{ $background->id }}" title="Edit Background" saveBtnText="Update" saveBtnType="submit" saveBtnForm="editForm{{ $background->id }}" size="md">
                @include('content.include.FeedBackground.editForm')
              </x-modal>
          </td>
      </tr>
      @empty
      <tr>
          <td class="text-center" colspan="8"><b>No Background  found.<b></td>
      </tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>