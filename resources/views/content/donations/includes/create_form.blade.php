<form id="createForm" action="{{ route('donations.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8 mx-auto">
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label" for="inputTitle">Title</label>
                <input type="text" id="inputTitle" name="title" class="form-control" value="{{ old('title') }}" placeholder="Title">
                @error('title')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label" for="inputDescription">Description</label>
                <textarea id="inputDescription" name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label" for="inputOrganizationId">Organization</label>
                <select id="inputOrganizationId" name="organization_id" class="form-control">
                <option value="" selected>Select</option>
                @foreach ($organizations as $org)
                    <option value="{{ $org->id }}" {{ (int) old('organization_id') === $org->id? 'selected': '' }}>{{ $org->name }}</option>
                @endforeach
                </select>
                @error('organization_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputStartDate">Start Date</label>
                <input type="text" id="inputStartDate" name="start_date" class="form-control" value="{{ old('start_date') }}">
                @error('start_date')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEndDate">End Date</label>
                <input type="text" id="inputEndDate" name="end_date" class="form-control" value="{{ old('end_date') }}">
                @error('end_date')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-4">
                <label for="inputTags" class="form-label">Tags</label>
                <input id="inputTags" class="form-control" name="tags" value="{{ old('tags') }}" />
                @error('tags')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="statusInput">Status</label>
                <select class="form-control" name="status" id="statusInput">
                    <option value="1" selected>Active</option>
                    <option value="0" {{ old('status') === '0'? 'selected': '' }}>Disabled</option>
                </select>
                @error('status')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-4">Create</button>
        </div>
    </div>
</form>