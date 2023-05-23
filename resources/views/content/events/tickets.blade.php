@extends('layouts/layoutMaster')

@section('title', 'Events - Tickets')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <div>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Events /</span> Tickets
</h4>
</div>
</div>
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Tickets List</h5>
    <div class="table-responsive text-nowrap">
    <table class="table">
        <thead>
          <tr>
            <th>Event Name</th>
            <th>Event Category</th>
            <th>Price Male</th>
            <th>Price Female</th>
            <th>Price Kids</th>
            <th>Total Sales</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($events as $event)
          <tr>
            <td>{{ $event->title }}</td>
            <td>{{ isset($event->category)? $event->category->name: '' }}</td>
            <td>{{ $event->price_male }}</td>
            <td>{{ $event->price_female }}</td>
            <td>{{ $event->price_kids }}</td>
            <td>{{ $event->ticketSales->count() }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @can('events.read')
                  <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ticketSalesModal">
                    View Sale History
                  </button>
                  @endcan
                </div>
              </div>
              <!-- Modal -->
              <x-modal 
                id="ticketSalesModal" 
                title="Ticket Sales"
                size="xl"
                :showSaveBtn="false"
              >
                <table class="table">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>Purchase Date</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @forelse($event->ticketSales as $sale)
                    <tr>
                      <td>{{ $sale->user? $sale->user->name: '' }}</td>
                      <td>{{ $sale->created_at->format('F jS, Y h:i a') }}</td>
                      <td>{{ $sale->total }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td class="text-center" colspan="3"><b>No sales found.<b></td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </x-modal>
              <!-- <div class="modal fade" id="ticketSalesModal" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Purchase Date</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          @forelse($event->ticketSales as $sale)
                          <tr>
                            <td>{{ $sale->user? $sale->user->name: '' }}</td>
                            <td>{{ $sale->created_at->format('F jS, Y h:i a') }}</td>
                            <td>{{ $sale->total }}</td>
                          </tr>
                          @empty
                          <tr>
                            <td class="text-center" colspan="8"><b>No sales found.<b></td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                  </div>
                </div>
              </div> -->
            </td>
          </tr>
          @empty
          <tr>
            <td class="text-center" colspan="8"><b>No tickets found.<b></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection
