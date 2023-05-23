<form id="editForm{{ $organization->id }}" action="{{ route('donations.organizations.update', $organization->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="showEditFormModal{{ $organization->id }}" value="1">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputName{{ $organization->id }}">Organization Name</label>
                    <input type="text" id="inputName{{ $organization->id }}" name="name" class="form-control" value="{{ old('name')?? $organization->name }}" placeholder="Organization Name">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputBankAccount{{ $organization->id }}">Bank Account</label>
                    <input type="text" id="inputBankAccount{{ $organization->id }}" name="bank_account" class="form-control" value="{{ old('bank_account')?? $organization->bank_account }}" placeholder="Bank Account">
                    @error('bank_account')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputPaypalAccount{{ $organization->id }}">Paypal Account</label>
                    <input type="text" id="inputPaypalAccount{{ $organization->id }}" name="paypal_account" class="form-control" value="{{ old('paypal_account')?? $organization->paypal_account }}" placeholder="Paypal Account">
                    @error('paypal_account')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputAddress{{ $organization->id }}">Address</label>
                    <input type="text" id="inputAddress{{ $organization->id }}" name="address" class="form-control" value="{{ old('address')?? $organization->address }}" placeholder="Address">
                    @error('address')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="logoInput{{ $organization->id }}">Upload Logo</label>
                    <input type="file" name="logo" id="logoInput{{ $organization->id }}" class="form-control">
                    @error('logo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>