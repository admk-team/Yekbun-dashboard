@extends('layouts/layoutMaster')

@section('title', 'Invoice List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('assets/js/app-invoice-list.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Invoice /</span> List
</h4>

<!-- Invoice List Table -->
<div class="card">
  <div class="card-datatable table-responsive">
    <table class="table border-top">
      <thead>
        <tr>
          <th></th>
          <th>#ID</th>
          <th>Client</th>
          <th>Total</th>
          <th class="text-truncate">Issued Date</th>
          <th class="text-truncate">Due Date</th>
          <th>Invoice Status</th>
        </tr>
      </thead>
        <tbody>
        @foreach($user_invoice as $invoice)
        <tr>
          <td></td>
           <td>{{ $invoice->invoice_no ?? '' }}</td>
           <td>
            <div class="d-flex justify-content-start align-items-center user-name">
            <div class="avatar-wrapper">
              <div class="avatar avatar-sm me-3">
                @if(isset($invoice->user))
                <img src="{{ asset('storage/'.$invoice->user->image) }}  " alt="Avatar" class="rounded-circle">
              @endif
            </div>
            </div>
            <div class="d-flex flex-column">
              <a href="javascript:void(0)" class="text-body text-truncate">
                <span class="fw-semibold">{{ $invoice->user->name ?? '' }}</span>
              </a>
              <small class="text-muted">{{ $invoice->user->email ?? '' }}</small>
            </div>
          </div>
        </td>
        <td>{{ $invoice->total ?? '' }}</td>
        <td>{{ $invoice->date ?? '' }}</td>
        <td>{{ $invoice->due_date ?? '' }}</td>
        <td>{{ $invoice->status ?? '' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
