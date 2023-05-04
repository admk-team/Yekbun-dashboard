<form id="createForm" action="{{ route('donations.organizations.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="showCreateFormModal" value="1">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputName">Organization Name</label>
                    <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name') }}" placeholder="Organization Name">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputBankAccount">Bank Account</label>
                    <input type="text" id="inputBankAccount" name="bank_account" class="form-control" value="{{ old('bank_account') }}" placeholder="Bank Account">
                    @error('bank_account')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputPaypalAccount">Paypal Account</label>
                    <input type="text" id="inputPaypalAccount" name="paypal_account" class="form-control" value="{{ old('paypal_account') }}" placeholder="Paypal Account">
                    @error('paypal_account')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputAddress">Address</label>
                    <input type="text" id="inputAddress" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                    @error('address')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="logoInput">Upload Logo</label>
                    <input type="file" name="logo" id="logoInput" class="form-control">
                    @error('logo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>