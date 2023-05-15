@extends('layouts/layoutMaster')

@section('title', 'Settings - Pricing')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .nav-tabs .nav-item .nav-link {
        padding: 1rem;
    }
</style>
@endsection

@section('vendor-script')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings /</span> Pricing
    </h4>
</div>

<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">Edit Pricing</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Price</th>
                                <th>Free</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>Standard</td>
                                <td x-data="{editPrice: false}">
                                    <div @click.prevent @dblclick="editPrice = !editPrice" @ class="bg-label-secondary py-2 px-3 rounded" style="width:fit-content">
                                        <div x-show="!editPrice">{{ $standard_price->value }}€</div>
                                        <!-- <div x-show="editPrice" class="">
                                            <input type="number" min="1" step="any" value="{{ $standard_price->value }}">
                                        </div> -->
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" onclick="confirmSettingUpdate(event)" type="checkbox" {{ $standard_is_free->value === 'true'? 'checked': '' }}>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
